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
}
