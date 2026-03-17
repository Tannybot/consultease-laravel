<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Faculty;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    public function dashboard()
    {
        $useremail = Session::get('user');

        $student = Student::where('semail', $useremail)->first();
        if (!$student) {
            return redirect('/login');
        }

        $today = date('Y-m-d');

        $facultyCount = Faculty::count();
        $studentCount = Student::count();
        $appointmentCount = DB::table('appointment')->where('appodate', '>=', $today)->count();
        $scheduleCount = DB::table('schedule')->where('scheduledate', $today)->count();

        $upcomingBookings = DB::table('schedule')
            ->join('appointment', 'schedule.scheduleid', '=', 'appointment.scheduleid')
            ->join('student', 'student.sid', '=', 'appointment.pid')
            ->join('faculty', 'schedule.facid', '=', 'faculty.facid')
            ->where('student.sid', $student->sid)
            ->where('schedule.scheduledate', '>=', $today)
            ->orderBy('schedule.scheduledate', 'asc')
            ->get();

        return view('student.dashboard', compact(
            'student', 'today', 'facultyCount', 'studentCount', 'appointmentCount', 'scheduleCount', 'upcomingBookings'
        ));
    }

    public function faculty(Request $request)
    {
        $useremail = Session::get('user');
        $student = Student::where('semail', $useremail)->first();
        if (!$student) {
            return redirect('/login');
        }

        $query = Faculty::query();

        if ($request->isMethod('post') && $request->has('search')) {
            $keyword = $request->input('search');
            $query->where(function ($q) use ($keyword) {
                $q->where('facemail', $keyword)
                    ->orWhere('facname', 'LIKE', "%{$keyword}%");
            });
        }

        $faculties = $query->orderBy('facid', 'desc')->get();

        // Get subjects for mapping
        $subjects = DB::table('subject')->get()->keyBy('id');

        // Handle specific actions (view, availability, book, etc.) if they were passed in query string,
        // but it's cleaner to handle these via modals/javascript or separate routes in Laravel.
        // For now, we will pass the list.

        $action = $request->query('action');
        $id = $request->query('id');
        $name = $request->query('name');

        $selectedFaculty = null;
        $availabilities = [];
        $spcil_name = 'Unknown';

        if ($action == 'view' && $id) {
            $selectedFaculty = Faculty::find($id);
            if ($selectedFaculty && isset($subjects[$selectedFaculty->subject])) {
                $spcil_name = $subjects[$selectedFaculty->subject]->sname;
            }
        }
        elseif ($action == 'availability' && $id) {
            $availabilityRecords = DB::table('faculty_availability')
                ->where('facid', $id)
                ->orderBy('day_of_week')
                ->get();

            foreach ($availabilityRecords as $record) {
                $availabilities[$record->day_of_week][] = $record;
            }
        }

        return view('student.faculty', compact(
            'student', 'faculties', 'subjects', 'action', 'id', 'name', 'selectedFaculty', 'spcil_name', 'availabilities'
        ));
    }

    public function schedule(Request $request)
    {
        $useremail = Session::get('user');
        $student = Student::where('semail', $useremail)->first();
        if (!$student) {
            return redirect('/login');
        }

        $today = date('Y-m-d');

        $query = DB::table('schedule')
            ->join('faculty', 'schedule.facid', '=', 'faculty.facid')
            ->where('schedule.scheduledate', '>=', $today);

        $searchQuery = '';
        $searchType = "All";

        if ($request->isMethod('post') && $request->has('search')) {
            $keyword = $request->input('search');
            if (!empty($keyword)) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('faculty.facname', 'LIKE', "%{$keyword}%")
                        ->orWhere('schedule.title', 'LIKE', "%{$keyword}%")
                        ->orWhere('schedule.scheduledate', 'LIKE', "%{$keyword}%");
                });
                $searchQuery = $keyword;
                $searchType = "Search Result: ";
            }
        }

        $schedules = $query->orderBy('schedule.scheduledate', 'asc')->get();

        $allFaculties = Faculty::orderBy('facname', 'asc')->get();
        $allTitles = DB::table('schedule')->select('title')->distinct()->get();

        // Get sessions already booked by this student mapping scheduleid -> appoid
        $myAppointments = DB::table('appointment')
            ->where('pid', $student->sid)
            ->pluck('appoid', 'scheduleid')
            ->toArray();
        $myBookings = array_keys($myAppointments);

        // Get session capacities
        $scheduleCapacities = DB::table('appointment')
            ->select('scheduleid', DB::raw('count(*) as total'))
            ->groupBy('scheduleid')
            ->pluck('total', 'scheduleid')->toArray();

        $action = $request->query('action', '');
        $error = $request->query('error', '0');
        $id = $request->query('id', '');
        $titleParam = $request->query('title', '');
        $docParam = $request->query('doc', '');

        return view('student.schedule', compact(
            'student', 'today', 'schedules', 'searchQuery', 'searchType', 'allFaculties', 'allTitles', 'action', 'error', 'id', 'titleParam', 'docParam', 'myBookings', 'myAppointments', 'scheduleCapacities', 'useremail'
        ));
    }

    public function addSession(Request $request)
    {
        $useremail = Session::get('user');
        $student = Student::where('semail', $useremail)->first();
        if (!$student) {
            return redirect('/login');
        }

        $request->validate([
            'title' => 'required|string',
            'docid' => 'required|integer', // facid
            'nop' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required'
        ]);

        $title = $request->input('title');
        $facid = $request->input('docid');
        $nop = $request->input('nop');
        $date = $request->input('date');
        $time = $request->input('time');

        // Optional logic from user: checking availability.
        // For now, based on original code, it seems the session is just created.
        $dayOfWeek = date('N', strtotime($date)); // 1=Mon, 7=Sun

        // Verify faculty is available at this time
        $availabilityCount = DB::table('faculty_availability')
            ->where('facid', $facid)
            ->where('day_of_week', $dayOfWeek)
            ->where('start_time', '<=', $time)
            ->where('end_time', '>=', $time)
            ->count();

        if ($availabilityCount == 0) {
            return redirect()->route('student.schedule', ['action' => 'add-session', 'error' => 'availability']);
        }

        DB::table('schedule')->insert([
            'facid' => $facid,
            'title' => $title,
            'scheduledate' => $date,
            'scheduletime' => $time,
            'nop' => $nop
        ]);

        return redirect()->route('student.schedule', ['action' => 'session-added', 'title' => $title]);
    }

    public function deleteSession(Request $request)
    {
        $scheduleid = $request->input('scheduleid');

        // Delete the schedule session row
        DB::table('schedule')->where('scheduleid', $scheduleid)->delete();

        // Also cascade delete any appointments tied to this session block
        DB::table('appointment')->where('scheduleid', $scheduleid)->delete();

        return redirect()->back()->with('success', 'Session completely deleted.');
    }

    public function deleteAppointment(Request $request)
    {
        $appoid = $request->input('appoid');

        // Find the appointment first to get its schedule ID
        $appointment = DB::table('appointment')->where('appoid', $appoid)->first();

        if ($appointment) {
            $scheduleid = $appointment->scheduleid;

            // Delete the student's booking
            DB::table('appointment')->where('appoid', $appoid)->delete();

            // If this was the only student booked for this schedule session, delete the session block entirely
            $remainingBookings = DB::table('appointment')->where('scheduleid', $scheduleid)->count();
            if ($remainingBookings == 0) {
                DB::table('schedule')->where('scheduleid', $scheduleid)->delete();
            }
        }

        return redirect()->back()->with('success', 'Appointment successfully cancelled.');
    }

    public function appointment(Request $request)
    {
        $useremail = Session::get('user');
        $student = Student::where('semail', $useremail)->first();
        if (!$student) {
            return redirect('/login');
        }

        $today = date('Y-m-d');

        $query = DB::table('schedule')
            ->join('appointment', 'schedule.scheduleid', '=', 'appointment.scheduleid')
            ->join('student', 'student.sid', '=', 'appointment.pid')
            ->join('faculty', 'schedule.facid', '=', 'faculty.facid')
            ->where('student.sid', $student->sid)
            ->whereNotIn('appointment.status', ['done', 'canceled', 'expired']);

        if ($request->isMethod('post') && $request->has('sheduledate') && !empty($request->input('sheduledate'))) {
            $sheduledate = $request->input('sheduledate');
            $query->where('schedule.scheduledate', $sheduledate);
        }

        $appointments = $query->orderBy('appointment.appodate', 'asc')->get();

        $action = $request->query('action', '');
        $id = $request->query('id', '');
        $titleParam = $request->query('title', '');
        $docParam = $request->query('doc', '');

        // Handle booking
        if ($action == 'add' && !empty($id)) {
            // Get the schedule
            $schedule = DB::table('schedule')->where('scheduleid', $id)->first();
            if ($schedule) {
                // Get the faculty member to send email to
                $faculty = DB::table('faculty')->where('facid', $schedule->facid)->first();

                // Determine the next appointment number
                // Count current appointments for this schedule
                $currentApptCount = DB::table('appointment')->where('scheduleid', $id)->count();

                // Check if student already booked this schedule
                $alreadyBooked = DB::table('appointment')
                    ->where('scheduleid', $id)
                    ->where('pid', $student->sid)
                    ->exists();

                if ($alreadyBooked) {
                    return redirect()->route('student.schedule')->with('error', 'You have already booked this session.');
                }

                // Check limit (nop)
                if ($currentApptCount >= $schedule->nop) {
                    return redirect()->route('student.schedule')->with('error', 'This session is already full.');
                }

                $apponum = $currentApptCount + 1;

                DB::table('appointment')->insert([
                    'pid' => $student->sid,
                    'apponum' => $apponum,
                    'scheduleid' => $id,
                    'appodate' => $today,
                    'status' => 'booked' // default status for a new booking
                ]);

                // redirect to success or just the bookings page
                return redirect()->route('student.appointment')->with('success', 'Appointment booked successfully! Faculty has been notified.');
            }
        }

        return view('student.appointment', compact(
            'student', 'today', 'appointments', 'action', 'id', 'titleParam', 'docParam'
        ));
    }

    public function settings(Request $request)
    {
        $useremail = Session::get('user');
        $student = Student::where('semail', $useremail)->first();
        if (!$student) {
            return redirect('/login');
        }

        $today = date('Y-m-d');

        $action = $request->query('action', '');
        $id = $request->query('id', '');
        $error = $request->query('error', '0');
        $nameget = $request->query('name', '');

        $viewStudent = null;
        if ($action == 'view' || $action == 'edit') {
            $viewStudent = Student::where('sid', $id)->first();
        }

        return view('student.settings', compact(
            'student', 'today', 'action', 'id', 'error', 'nameget', 'viewStudent'
        ));
    }

    public function editStudent(Request $request)
    {
        $id = $request->input('id00');
        $name = $request->input('name');
        $oldemail = $request->input('oldemail');
        $email = $request->input('email');
        $tele = $request->input('Tele');
        $address = $request->input('address');
        $password = $request->input('password');
        $cpassword = $request->input('cpassword');

        $updateData = [
            'sname' => $name,
            'spassword' => $password,
            'stel' => $tele,
            'saddress' => $address
        ];

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('profile_pictures', 'public');
            $updateData['profile_pic'] = $path;
        }

        if ($password == $cpassword) {
            $error = '3';
            // Check if email already exists
            $existingUser = DB::table('webuser')->where('email', $email)->first();

            if ($existingUser || $existingUser->email == $oldemail) {
                // If the email is the same as the old email, it's fine.
                // If it's different and already exists, error 1.
                if ($oldemail != $email && $existingUser) {
                    $error = '1';
                }
                else {
                    $updateData['semail'] = $email;
                    DB::table('student')->where('sid', $id)->update($updateData);

                    DB::table('webuser')->where('email', $oldemail)->update([
                        'email' => $email
                    ]);
                    $error = '4'; // Success
                }
            }
            else {
                $updateData['semail'] = $email;
                DB::table('student')->where('sid', $id)->update($updateData);

                DB::table('webuser')->where('email', $oldemail)->update([
                    'email' => $email
                ]);
                $error = '4'; // Success
            }
        }
        else {
            $error = '2'; // Password mismatch
        }

        return redirect()->route('student.settings', ['action' => 'edit', 'error' => $error, 'id' => $id]);
    }

    public function deleteAccount(Request $request)
    {
        $id = $request->query('id');
        $useremail = Session::get('user');

        DB::table('student')->where('sid', $id)->delete();
        DB::table('webuser')->where('email', $useremail)->delete();

        Session::forget('user');
        Session::forget('usertype');

        return redirect('/login');
    }
}
