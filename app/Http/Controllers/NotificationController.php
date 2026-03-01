<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WebNotification;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    // Fetches all notifications for the currently logged-in user
    public function fetch(Request $request)
    {
        $userEmail = Session::get('user');
        $usertype = Session::get('usertype');

        if (!$userEmail || !$usertype) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // Determine the user's ID based on their type
        $userId = null;
        if ($usertype === 's') { // Student
            $student = Student::where('semail', $userEmail)->first();
            if ($student)
                $userId = $student->sid;
            $typeString = 'student';
        }
        elseif ($usertype === 'd') { // Faculty
            $faculty = Faculty::where('facemail', $userEmail)->first();
            if ($faculty)
                $userId = $faculty->facid;
            $typeString = 'faculty';
        }
        elseif ($usertype === 'a') { // Admin
            $admin = Admin::where('aemail', $userEmail)->first();
            if ($admin)
                $userId = $admin->aemail; // Assuming admin uses email as ID or similar
            $typeString = 'admin';
        }

        if (!$userId) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $notifications = WebNotification::where('user_id', $userId)
            ->where('user_type', $typeString)
            ->orderBy('created_at', 'desc')
            ->get();

        $unreadCount = $notifications->where('is_read', false)->count();

        return response()->json([
            'unread_count' => $unreadCount,
            'notifications' => $notifications
        ]);
    }

    // Mark a specific notification as read, or all if no ID is passed
    public function markAsRead(Request $request)
    {
        $id = $request->input('id');

        $userEmail = Session::get('user');
        $usertype = Session::get('usertype');

        if (!$userEmail || !$usertype) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        if ($id) {
            WebNotification::where('id', $id)->update(['is_read' => true]);
        }
        else {
            // Determine user
            $userId = null;
            if ($usertype === 's')
                $userId = Student::where('semail', $userEmail)->value('sid');
            elseif ($usertype === 'd')
                $userId = Faculty::where('facemail', $userEmail)->value('facid');
            elseif ($usertype === 'a')
                $userId = Admin::where('aemail', $userEmail)->value('aemail');

            if ($userId) {
                WebNotification::where('user_id', $userId)->update(['is_read' => true]);
            }
        }

        return response()->json(['success' => true]);
    }

    // Allows the frontend to log a new notification (e.g. EmailJS Success)
    public function log(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'user_type' => 'required',
            'title' => 'required',
            'message' => 'required'
        ]);

        WebNotification::create([
            'user_id' => $request->input('user_id'),
            'user_type' => $request->input('user_type'),
            'title' => $request->input('title'),
            'message' => $request->input('message'),
            'is_read' => false
        ]);

        return response()->json(['success' => true]);
    }
}
