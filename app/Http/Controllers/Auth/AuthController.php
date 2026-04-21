<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\WebUser;
use App\Models\Admin\Admin;
use App\Models\Faculty\Faculty;
use App\Models\Student\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'useremail' => 'required|email|max:255',
            'userpassword' => 'required|string'
        ]);

        $email = $request->input('useremail');
        $password = $request->input('userpassword');

        $webuser = WebUser::where('email', $email)->first();

        if ($webuser) {
            $utype = $webuser->usertype;
            $authenticated = false;

            if ($utype == 's') {
                $student = Student::where('semail', $email)->first();
                if ($student && $this->verifyPassword($password, $student->spassword)) {
                    if (!$this->passwordIsHashed($student->spassword)) {
                        $student->spassword = $this->hashPassword($password);
                        $student->save();
                    }
                    $authenticated = true;
                }
            }
            elseif ($utype == 'a') {
                $admin = Admin::where('aemail', $email)->first();
                if ($admin && $this->verifyPassword($password, $admin->apassword)) {
                    if (!$this->passwordIsHashed($admin->apassword)) {
                        $admin->apassword = $this->hashPassword($password);
                        $admin->save();
                    }
                    $authenticated = true;
                }
            }
            elseif ($utype == 'f') {
                $faculty = Faculty::where('facemail', $email)->first();
                if ($faculty && $this->verifyPassword($password, $faculty->facpassword)) {
                    if (!$this->passwordIsHashed($faculty->facpassword)) {
                        $faculty->facpassword = $this->hashPassword($password);
                        $faculty->save();
                    }
                    $authenticated = true;
                }
            }

            if ($authenticated) {
                // Check if Google 2FA is enabled for this user
                if ($webuser->google_2fa_enabled && $webuser->google_id) {
                    // Store credentials temporarily for 2FA verification
                    Session::put('2fa_pending_email', $email);
                    Session::put('2fa_pending_usertype', $utype);
                    return redirect()->route('google.verify');
                }

                // Normal login — no 2FA
                $request->session()->regenerate();
                Session::put('user', $email);
                Session::put('usertype', $utype);
                return $this->redirectToDashboard($utype);
            }

            return back()->with('error', 'Wrong credentials: Invalid email or password');
        }

        return back()->with('error', 'We cant found any account for this email.');
    }

    /**
     * Show the Google 2FA verification page
     */
    public function showGoogleVerify()
    {
        if (!Session::has('2fa_pending_email')) {
            return $this->redirectToLogin()->with('error', 'Please login first.');
        }
        return view('auth.google-verify');
    }

    /**
     * Redirect user to Google OAuth consent screen
     */
    public function redirectToGoogle()
    {
        // Determine the purpose: 2fa verification or account linking
        $purpose = Session::has('2fa_pending_email') ? '2fa' : 'link';
        Session::put('google_oauth_purpose', $purpose);

        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    /**
     * Handle the callback from Google OAuth
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return $this->redirectToLogin()->with('error', 'Google authentication failed. Please try again.');
        }

        $purpose = Session::get('google_oauth_purpose', '2fa');

        if ($purpose === '2fa') {
            return $this->handleGoogle2FAVerification($googleUser);
        } else {
            return $this->handleGoogleAccountLinking($googleUser);
        }
    }

    /**
     * Handle Google 2FA verification after password login
     */
    private function handleGoogle2FAVerification($googleUser)
    {
        $email = Session::get('2fa_pending_email');
        $usertype = Session::get('2fa_pending_usertype');

        if (!$email || !$usertype) {
            return $this->redirectToLogin()->with('error', 'Session expired. Please login again.');
        }

        $webuser = WebUser::where('email', $email)->first();

        if (!$webuser || $webuser->google_id !== $googleUser->getId()) {
            // Clear pending session
            Session::forget(['2fa_pending_email', '2fa_pending_usertype', 'google_oauth_purpose']);
            return $this->redirectToLogin()->with('error', 'Google account mismatch. Please use the Google account linked to your ConsultEase account.');
        }

        // 2FA verified — complete login
        Session::forget(['2fa_pending_email', '2fa_pending_usertype', 'google_oauth_purpose']);
        Session::put('user', $email);
        Session::put('usertype', $usertype);

        return $this->redirectToDashboard($usertype);
    }

    /**
     * Handle linking a Google account to the current user
     */
    private function handleGoogleAccountLinking($googleUser)
    {
        Session::forget('google_oauth_purpose');

        $email = $this->sessionUserEmail();
        if (!$email) {
            return $this->redirectToLogin()->with('error', 'Please login first.');
        }

        $webuser = WebUser::where('email', $email)->first();
        if (!$webuser) {
            return $this->redirectToLogin()->with('error', 'User not found.');
        }

        // Check if this Google ID is already linked to another account
        $existing = WebUser::where('google_id', $googleUser->getId())
            ->where('email', '!=', $email)
            ->first();

        if ($existing) {
            $redirectUrl = $this->getSettingsUrl($webuser->usertype);
            return redirect($redirectUrl)->with('error', 'This Google account is already linked to another ConsultEase account.');
        }

        // Link the Google account and enable 2FA
        $webuser->google_id = $googleUser->getId();
        $webuser->google_2fa_enabled = true;
        $webuser->save();

        $redirectUrl = $this->getSettingsUrl($webuser->usertype);
        return redirect($redirectUrl)->with('success', 'Google 2FA has been enabled successfully! Your account is now linked to ' . $googleUser->getEmail());
    }

    /**
     * Enable Google 2FA — redirect to Google to link account
     */
    public function enableGoogle2FA()
    {
        if (!Session::has('user')) {
            return $this->redirectToLogin();
        }

        Session::put('google_oauth_purpose', 'link');

        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    /**
     * Disable Google 2FA
     */
    public function disableGoogle2FA(Request $request)
    {
        $email = $this->sessionUserEmail();
        if (!$email) {
            return $this->redirectToLogin();
        }

        $webuser = WebUser::where('email', $email)->first();
        if ($webuser) {
            $webuser->google_id = null;
            $webuser->google_2fa_enabled = false;
            $webuser->save();
        }

        $usertype = $this->sessionUserType();
        $redirectUrl = $this->getSettingsUrl($usertype);
        return redirect($redirectUrl)->with('success', 'Google 2FA has been disabled.');
    }

    /**
     * Redirect to the appropriate dashboard based on user type
     */
    private function redirectToDashboard($utype)
    {
        switch ($utype) {
            case 's': return redirect('/student/dashboard');
            case 'a': return redirect('/admin/dashboard');
            case 'f': return redirect('/faculty/dashboard');
            default:  return $this->redirectToLogin();
        }
    }

    /**
     * Get settings URL based on user type
     */
    private function getSettingsUrl($utype)
    {
        switch ($utype) {
            case 's': return '/student/settings';
            case 'f': return '/faculty/settings';
            case 'a': return '/admin/settings';
            default:  return '/login';
        }
    }

    // ──────────────────────────────────────────────
    // Signup Methods (unchanged)
    // ──────────────────────────────────────────────

    public function showSignup()
    {
        return view('auth.signup');
    }

    public function processSignupRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:student,faculty',
        ]);

        $role = $request->input('role');
        if ($role == 'student') {
            return redirect()->route('signup.student');
        }
        elseif ($role == 'faculty') {
            return redirect()->route('signup.faculty');
        }
        return back()->with('error', 'Please select a role.');
    }

    public function showStudentSignup()
    {
        return view('auth.signup-student');
    }

    public function registerStudent(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:100',
            'lname' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
            'newemail' => 'required|email|max:255|unique:webuser,email',
            'tele' => 'required|regex:/^\d{11}$/',
            'newpassword' => 'required|string|min:8',
            'cpassword' => 'required|same:newpassword'
        ]);

        $name = trim($request->input('fname') . ' ' . $request->input('lname'));
        $email = $request->input('newemail');

        Student::insert([
            'semail' => $email,
            'sname' => $name,
            'spassword' => $this->hashPassword($request->input('newpassword')),
            'saddress' => $request->input('address'),
            'snic' => '',
            'sdob' => $request->input('dob'),
            'stel' => $request->input('tele')
        ]);

        WebUser::insert([
            'email' => $email,
            'usertype' => 's'
        ]);

        $request->session()->regenerate();
        Session::put('user', $email);
        Session::put('usertype', 's');
        Session::put('username', $request->input('fname'));

        return redirect('/student/dashboard');
    }

    public function showFacultySignup()
    {
        $subjects = $this->subjectOptions();

        return view('auth.signup-faculty', compact('subjects'));
    }

    public function registerFaculty(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:100',
            'lname' => 'required|string|max:100',
            'newemail' => 'required|email|max:255|unique:webuser,email',
            'tele' => 'required|regex:/^\d{11}$/',
            'subject' => 'required|string|max:255',
            'newpassword' => 'required|string|min:8',
            'cpassword' => 'required|same:newpassword'
        ]);

        $name = trim($request->input('fname') . ' ' . $request->input('lname'));
        $email = $request->input('newemail');
        $subjectId = $this->resolveSubjectId($request->input('subject'));

        if (!$subjectId) {
            return back()->withInput()->with('error', 'Please select or enter a valid subject.');
        }

        Faculty::insert([
            'facemail' => $email,
            'facname' => $name,
            'facpassword' => $this->hashPassword($request->input('newpassword')),
            'factel' => $request->input('tele'),
            'subject' => $subjectId
        ]);

        WebUser::insert([
            'email' => $email,
            'usertype' => 'f'
        ]);

        $request->session()->regenerate();
        Session::put('user', $email);
        Session::put('usertype', 'f');
        Session::put('username', $request->input('fname'));

        return redirect('/faculty/dashboard');
    }

    public function logout(Request $request)
    {
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->redirectToLogin();
    }
}
