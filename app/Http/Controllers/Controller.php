<?php

namespace App\Http\Controllers;

use App\Models\Admin\Admin;
use App\Models\Faculty\Faculty;
use App\Models\Student\Student;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function sessionUserEmail(): ?string
    {
        return Session::get('user');
    }

    protected function sessionUserType(): ?string
    {
        return Session::get('usertype');
    }

    protected function redirectToLogin(): RedirectResponse
    {
        return redirect()->route('login');
    }

    protected function authenticatedStudent(): ?Student
    {
        $email = $this->sessionUserEmail();

        return $email ? Student::where('semail', $email)->first() : null;
    }

    protected function authenticatedFaculty(): ?Faculty
    {
        $email = $this->sessionUserEmail();

        return $email ? Faculty::where('facemail', $email)->first() : null;
    }

    protected function authenticatedAdmin(): ?Admin
    {
        $email = $this->sessionUserEmail();

        return $email ? Admin::where('aemail', $email)->first() : null;
    }

    protected function subjectOptions()
    {
        return DB::table('subject')->orderBy('sname')->get();
    }

    protected function resolveSubjectId($subjectInput)
    {
        if (is_numeric($subjectInput)) {
            $subject = DB::table('subject')->where('id', (int) $subjectInput)->first();
            if ($subject) {
                return $subject->id;
            }
        }

        $subjectName = trim((string) $subjectInput);
        if ($subjectName === '') {
            return null;
        }

        $existingSubject = DB::table('subject')->where('sname', $subjectName)->first();

        return $existingSubject
            ? $existingSubject->id
            : DB::table('subject')->insertGetId(['sname' => $subjectName]);
    }

    protected function hashPassword(string $plainPassword): string
    {
        return Hash::make($plainPassword);
    }

    protected function passwordIsHashed(?string $storedPassword): bool
    {
        if (!$storedPassword) {
            return false;
        }

        return password_get_info($storedPassword)['algo'] !== 0;
    }

    protected function verifyPassword(string $plainPassword, ?string $storedPassword): bool
    {
        if (!$storedPassword) {
            return false;
        }

        if ($this->passwordIsHashed($storedPassword)) {
            return Hash::check($plainPassword, $storedPassword);
        }

        return hash_equals($storedPassword, $plainPassword);
    }
}
