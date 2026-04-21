<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty\Faculty;
use App\Models\Auth\WebUser;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class FacultyController extends Controller
{
    public function dashboard()
    {
        $faculty = $this->authenticatedFaculty();
        if (!$faculty) {
            return $this->redirectToLogin();
        }

        $today = date('Y-m-d');

        $nextweek = date("Y-m-d", strtotime("+1 week"));

        // Fetch Upcoming Sessions for this week
        $upcomingSessions = DB::table('schedule')
            ->join('faculty', 'schedule.facid', '=', 'faculty.facid')
            ->where('schedule.facid', $faculty->facid)
            ->where('schedule.scheduledate', '>=', $today)
            ->where('schedule.scheduledate', '<=', $nextweek)
            ->orderBy('schedule.scheduledate', 'desc')
            ->get();

        return view('faculty.dashboard', compact('faculty', 'today', 'upcomingSessions'));
    }

    public function appointment(Request $request)
    {
        $faculty = $this->authenticatedFaculty();
        if (!$faculty) {
            return $this->redirectToLogin();
        }

        $today = date('Y-m-d');

        // Fetch all schedules for the faculty
        $schedules = [];
        $scheduleRecords = DB::table('schedule')
            ->where('facid', $faculty->facid)
            ->where('scheduledate', '>=', $today)
            ->orderBy('scheduledate', 'asc')
            ->orderBy('scheduletime', 'asc')
            ->get();

        foreach ($scheduleRecords as $row) {
            $date = $row->scheduledate;
            if (!isset($schedules[$date])) {
                $schedules[$date] = [];
            }
            $schedules[$date][] = (array)$row;
        }

        // Fetch appointments grouped by date
        $appointments = [];
        $appointmentRecords = DB::table('schedule')
            ->join('appointment', 'schedule.scheduleid', '=', 'appointment.scheduleid')
            ->join('student', 'student.sid', '=', 'appointment.pid')
            ->where('schedule.facid', $faculty->facid)
            ->where('schedule.scheduledate', '>=', $today)
            ->whereNotIn('appointment.status', ['done', 'canceled', 'expired'])
            ->select(
            'appointment.appoid', 'schedule.scheduleid', 'schedule.title',
            'student.sname', 'schedule.scheduledate', 'schedule.scheduletime',
            'appointment.apponum', 'appointment.appodate'
        )
            ->orderBy('schedule.scheduledate', 'asc')
            ->orderBy('schedule.scheduletime', 'asc')
            ->get();

        foreach ($appointmentRecords as $row) {
            $date = $row->scheduledate;
            if (!isset($appointments[$date])) {
                $appointments[$date] = [];
            }
            $appointments[$date][] = (array)$row;
        }

        $id = $request->query('id', '');
        $action = $request->query('action', '');
        $nameget = $request->query('name', '');
        $apponum = $request->query('apponum', '');

        return view('faculty.appointment', compact(
            'faculty', 'today', 'schedules', 'appointments', 'id', 'action', 'nameget', 'apponum'
        ));
    }

    public function deleteAppointment(Request $request)
    {
        $appoid = $request->input('appoid');
        DB::table('appointment')->where('appoid', $appoid)->delete();
        return redirect()->route('faculty.appointment');
    }

    public function markDone(Request $request)
    {
        $appoid = $request->query('id');
        // Depending on system logic, maybe update status or delete
        DB::table('appointment')->where('appoid', $appoid)->update(['status' => 'done']);
        return redirect()->route('faculty.appointment');
    }

    public function submitReview(Request $request)
    {
        // Simple mock review functionality.
        return redirect()->route('faculty.appointment')->with('review', 'success');
    }

    public function schedule(Request $request)
    {
        $faculty = $this->authenticatedFaculty();
        if (!$faculty) {
            return $this->redirectToLogin();
        }

        $today = date('Y-m-d');

        $query = DB::table('schedule')
            ->join('faculty', 'schedule.facid', '=', 'faculty.facid')
            ->where('faculty.facid', $faculty->facid);

        if ($request->isMethod('post') && $request->has('sheduledate') && !empty($request->input('sheduledate'))) {
            $sheduledate = $request->input('sheduledate');
            $query->where('schedule.scheduledate', $sheduledate);
        }

        $schedules = $query->orderBy('schedule.scheduledate', 'asc')->get();

        $action = $request->query('action', '');
        $id = $request->query('id', '');
        $nameget = $request->query('name', '');

        $sessionDetails = null;
        $sessionStudents = [];

        if ($action == 'view' && !empty($id)) {
            $sessionDetails = DB::table('schedule')
                ->join('faculty', 'schedule.facid', '=', 'faculty.facid')
                ->where('schedule.scheduleid', $id)
                ->first();

            $sessionStudents = DB::table('appointment')
                ->join('student', 'student.sid', '=', 'appointment.pid')
                ->where('appointment.scheduleid', $id)
                ->get();
        }

        return view('faculty.schedule', compact(
            'faculty', 'today', 'schedules', 'action', 'id', 'nameget', 'sessionDetails', 'sessionStudents'
        ));
    }

    public function deleteSession(Request $request)
    {
        $id = $request->input('id');

        // Cascade delete any appointments tied to this session block
        DB::table('appointment')->where('scheduleid', $id)->delete();

        // Delete the schedule session row itself
        DB::table('schedule')->where('scheduleid', $id)->delete();

        return redirect()->route('faculty.schedule');
    }

    public function student()
    {
        $faculty = $this->authenticatedFaculty();
        if (!$faculty) {
            return $this->redirectToLogin();
        }

        $today = date('Y-m-d');
        $message = 'Student records are managed by the administration. Faculty members can continue using appointments and schedules from the dashboard.';

        return view('faculty.student', compact('faculty', 'today', 'message'));
    }

    public function settings(Request $request)
    {
        $faculty = $this->authenticatedFaculty();
        if (!$faculty) {
            return $this->redirectToLogin();
        }
        $useremail = $faculty->facemail;

        $today = date('Y-m-d');
        $action = $request->query('action', $request->input('action', ''));
        $id = (string) $faculty->facid;
        $error_1 = $request->query('error', '0');
        $nameget = $request->query('name', $request->input('name', ''));

        $availabilities = [];
        $bookings = [];

        if ($action == 'availability' && !empty($id)) {
            $availRecords = DB::table('faculty_availability')
                ->where('facid', $id)
                ->orderBy('day_of_week')
                ->get();
            foreach ($availRecords as $row) {
                $availabilities[$row->day_of_week][] = (array)$row;
            }
        }
        elseif ($action == 'history' && !empty($id)) {
            $query = DB::table('appointment')
                ->join('schedule', 'appointment.scheduleid', '=', 'schedule.scheduleid')
                ->join('faculty', 'schedule.facid', '=', 'faculty.facid')
                ->join('subject', 'faculty.subject', '=', 'subject.id')
                ->select('appointment.appoid', 'appointment.appodate', 'schedule.scheduletime', 'schedule.title', 'subject.sname as subject_name', 'appointment.status')
                ->where('schedule.facid', $id)
                ->whereIn('appointment.status', ['done', 'expired']);

            if ($request->has('from_date') && !empty($request->input('from_date'))) {
                $query->where('appointment.appodate', '>=', $request->input('from_date'));
            }
            if ($request->has('to_date') && !empty($request->input('to_date'))) {
                $query->where('appointment.appodate', '<=', $request->input('to_date'));
            }
            if ($request->has('subject') && !empty($request->input('subject'))) {
                $query->where('faculty.subject', $request->input('subject'));
            }

            $bookings = $query->orderBy('appointment.appodate', 'desc')
                ->orderBy('schedule.scheduletime', 'desc')
                ->get();
        }

        $subjects = $this->subjectOptions();

        $webuser = WebUser::where('email', $useremail)->first();

        return view('faculty.settings', compact(
            'faculty', 'today', 'action', 'id', 'error_1', 'nameget', 'availabilities', 'bookings', 'subjects', 'request', 'webuser'
        ));
    }

    public function editFaculty(Request $request)
    {
        $faculty = $this->authenticatedFaculty();
        if (!$faculty) {
            return $this->redirectToLogin();
        }

        if ($request->has('action') && $request->input('action') == 'update_availability') {
            $facid = $faculty->facid;
            $start_times = $request->input('start_time');
            $end_times = $request->input('end_time');

            DB::table('faculty_availability')->where('facid', $facid)->delete();

            if (!empty($start_times) && !empty($end_times)) {
                $inserts = [];
                for ($d = 1; $d <= 7; $d++) {
                    if (isset($start_times[$d]) && isset($end_times[$d])) {
                        for ($i = 0; $i < count($start_times[$d]); $i++) {
                            if (!empty($start_times[$d][$i]) && !empty($end_times[$d][$i])) {
                                $inserts[] = [
                                    'facid' => $facid,
                                    'day_of_week' => $d,
                                    'start_time' => $start_times[$d][$i],
                                    'end_time' => $end_times[$d][$i]
                                ];
                            }
                        }
                    }
                }
                if (count($inserts) > 0) {
                    DB::table('faculty_availability')->insert($inserts);
                }
            }

            return redirect()->route('faculty.settings')->with('success', 'Availability updated');
        }
        else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'Tele' => 'required|regex:/^\d{11}$/',
                'spec' => 'required|string|max:255',
                'password' => 'required|string|min:8',
                'cpassword' => 'required|same:password',
                'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $id = $faculty->facid;
            $name = $request->input('name');
            $oldemail = $faculty->facemail;
            $email = $request->input('email');
            $tele = $request->input('Tele');
            $spec = $request->input('spec');
            $password = $request->input('password');
            $cpassword = $request->input('cpassword');
            $subjectId = $this->resolveSubjectId($spec);

            if (!$subjectId) {
                return redirect('/faculty/settings?action=edit&id=' . $id . '&error=3');
            }

            $updateData = [
                'facname' => $name,
                'facpassword' => $this->hashPassword($password),
                'factel' => $tele,
                'subject' => $subjectId
            ];

            if ($request->hasFile('profile_pic')) {
                $path = $request->file('profile_pic')->store('profile_pictures', 'public');
                $updateData['profile_pic'] = $path;
            }

            if ($password == $cpassword) {
                $existingUser = DB::table('webuser')->where('email', $email)->first();
                if ($existingUser == null || $email == $oldemail) {
                    DB::table('webuser')->where('email', $oldemail)->update(['email' => $email]);
                    $updateData['facemail'] = $email;
                    DB::table('faculty')->where('facid', $id)->update($updateData);
                    Session::put('user', $email);
                    return redirect('/faculty/settings?action=edit&id=' . $id . '&error=4');
                }
                else {
                    return redirect('/faculty/settings?action=edit&id=' . $id . '&error=1');
                }
            }
            else {
                return redirect('/faculty/settings?action=edit&id=' . $id . '&error=2');
            }
        }
    }

    public function deleteAccount(Request $request)
    {
        $faculty = $this->authenticatedFaculty();
        if ($faculty) {
            DB::table('webuser')->where('email', $faculty->facemail)->delete();
            $faculty->delete();
        }
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->redirectToLogin();
    }
}
