<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseNotificationController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'token' => 'required|string',
        ]);

        // Use the correct config path for credentials
        $credentialsPath = config('firebase.projects.app.credentials.file');
        if (is_null($credentialsPath)) {
            return response()->json(['status' => 'error', 'message' => 'FIREBASE_CREDENTIALS is null or not set in config. Check your .env and config/firebase.php.'], 500);
        }

        $factory = (new Factory())
            ->withServiceAccount($credentialsPath)
            ->withProjectId(env('FIREBASE_PROJECT_ID'));

        $messaging = $factory->createMessaging();

        $message = CloudMessage::withTarget('token', $request->token)
            ->withNotification(Notification::create($request->title, $request->body));

        try {
            $messaging->send($message);
            return response()->json(['status' => 'success']);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function getNotifications(Request $request)
    {
        // المستخدم من خلال التوكين
        $user = $request->user();

         $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        return response()->json([
            'status' => true,
            'count' => $notifications->count(),
            'notifications' => $notifications->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'title' => $notification->title ?? null,   // من عندك بالـ migration
                    'data' => $notification->data,
                    // 'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at->toDateTimeString(),
                ];
            }),
        ]);
    }
}
 