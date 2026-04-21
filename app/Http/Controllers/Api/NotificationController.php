<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\WebNotification;
use App\Models\Student\Student;
use App\Models\Faculty\Faculty;
use App\Models\Admin\Admin;

class NotificationController extends Controller
{
    private function resolveCurrentNotificationUser(): array
    {
        $userEmail = $this->sessionUserEmail();
        $usertype = $this->sessionUserType();

        if (!$userEmail || !$usertype) {
            return [null, null];
        }

        $typeString = null;

        if ($usertype === 's') {
            $exists = Student::where('semail', $userEmail)->exists();
            $typeString = 'student';
        } elseif ($usertype === 'd' || $usertype === 'f') {
            $exists = Faculty::where('facemail', $userEmail)->exists();
            $typeString = 'faculty';
        } elseif ($usertype === 'a') {
            $exists = Admin::where('aemail', $userEmail)->exists();
            $typeString = 'admin';
        } else {
            $exists = false;
        }

        if (!$exists || !$typeString) {
            return [null, null];
        }

        return [$userEmail, $typeString];
    }

    public function fetch(Request $request)
    {
        [$userId, $typeString] = $this->resolveCurrentNotificationUser();

        if (!$userId || !$typeString) {
            return response()->json(['error' => 'Unauthenticated'], 401);
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
        [$userId, $typeString] = $this->resolveCurrentNotificationUser();

        if (!$userId || !$typeString) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        if ($id) {
            WebNotification::where('id', $id)
                ->where('user_id', $userId)
                ->where('user_type', $typeString)
                ->update(['is_read' => true]);
        } else {
            WebNotification::where('user_id', $userId)
                ->where('user_type', $typeString)
                ->update(['is_read' => true]);
        }

        return response()->json(['success' => true]);
    }

    public function log(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'message' => 'required|string|max:1000'
        ]);

        [$userId, $userType] = $this->resolveCurrentNotificationUser();

        if (!$userId || !$userType) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        WebNotification::create([
            'user_id' => (string) $userId,
            'user_type' => $userType,
            'title' => $request->input('title'),
            'message' => $request->input('message'),
            'is_read' => false
        ]);

        return response()->json(['success' => true]);
    }
}
