<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\WebNotification;
use App\Models\Student\Student;
use App\Models\Faculty\Faculty;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function fetch(Request $request)
    {
        $userEmail = Session::get('user');
        $usertype = Session::get('usertype');

        if (!$userEmail || !$usertype) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $userId = null;
        if ($usertype === 's') {
            $student = Student::where('semail', $userEmail)->first();
            if ($student) $userId = $student->sid;
            $typeString = 'student';
        } elseif ($usertype === 'd') {
            $faculty = Faculty::where('facemail', $userEmail)->first();
            if ($faculty) $userId = $faculty->facid;
            $typeString = 'faculty';
        } elseif ($usertype === 'a') {
            $admin = Admin::where('aemail', $userEmail)->first();
            if ($admin) $userId = $admin->aemail;
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
        } else {
            $userId = null;
            if ($usertype === 's') $userId = Student::where('semail', $userEmail)->value('sid');
            elseif ($usertype === 'd') $userId = Faculty::where('facemail', $userEmail)->value('facid');
            elseif ($usertype === 'a') $userId = Admin::where('aemail', $userEmail)->value('aemail');

            if ($userId) {
                WebNotification::where('user_id', $userId)->update(['is_read' => true]);
            }
        }

        return response()->json(['success' => true]);
    }

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
