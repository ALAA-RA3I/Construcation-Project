<?php

namespace App\Http\Controllers;

use App\Models\UserPropertyUnitInstallments;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FcmNotification;

class InstallmentNotificationController extends Controller
{
    public function sendNotifications()
    {
        Log::info("🚀 Starting installment notifications via route");

        $today = Carbon::today();

        // Installments due soon (within 5 days)
        $dueSoon = UserPropertyUnitInstallments::where('is_paid', false)
            ->whereBetween('due_date', [$today, $today->copy()->addDays(5)])
            ->get();

        // Overdue by 1 day
        $overdue1 = UserPropertyUnitInstallments::where('is_paid', false)
            ->whereDate('due_date', $today->copy()->subDay())
            ->get();

        // Overdue by 10 days
        $overdue10 = UserPropertyUnitInstallments::where('is_paid', false)
            ->whereDate('due_date', $today->copy()->subDays(10))
            ->get();

        Log::info("📊 Installment stats: dueSoon=" . $dueSoon->count() . ", overdue1=" . $overdue1->count() . ", overdue10=" . $overdue10->count());

        // Send notifications
        foreach ($dueSoon as $installment) {
            $this->sendNotification(
                $installment->client_id,
                'Upcoming Installment Reminder',
                "Your installment (ID: {$installment->id}) is due on {$installment->due_date->format('Y-m-d')}. Please ensure payment within the next 5 days to avoid penalties."
            );
        }

        foreach ($overdue1 as $installment) {
            $this->sendNotification(
                $installment->client_id,
                'Installment Overdue - 1 Day',
                "Your installment (ID: {$installment->id}) was due on {$installment->due_date->format('Y-m-d')} and is now overdue by 1 day. Please make the payment immediately to avoid further late fees."
            );
        }

        foreach ($overdue10 as $installment) {
            $this->sendNotification(
                $installment->client_id,
                'Installment Seriously Overdue - 10 Days',
                "Your installment (ID: {$installment->id}) was due on {$installment->due_date->format('Y-m-d')} and is now overdue by 10 days. Immediate action is required to prevent additional penalties or account restrictions."
            );
        }

        Log::info("✅ Finished sending installment notifications");
        return response()->json(['status' => 'success', 'message' => 'Installment notifications sent successfully']);
    }

    private function sendNotification($clientId, $title, $body)
    {
        Log::info("📩 Sending notification to Client ID={$clientId} with title: {$title}");

        $client = Client::find($clientId);
        if (!$client) {
            Log::warning("⚠️ Client not found, ID={$clientId}");
            return;
        }

        // Store notification in database
        $client->notifications()->create([
            'id' => \Illuminate\Support\Str::uuid(),
            'title' => $title,
            'data' => json_encode([
                'body' => $body,
            ]),
        ]);

        // Send via Firebase if device_token exists
        if ($client->device_token) {
            $credentialsPath = config('firebase.projects.app.credentials.file');
            if (!$credentialsPath) {
                Log::error("❌ Firebase credentials file not found");
                return;
            }

            $factory = (new Factory())->withServiceAccount($credentialsPath);
            $messaging = $factory->createMessaging();

            $message = CloudMessage::withTarget('token', $client->device_token)
                ->withNotification(FcmNotification::create($title, $body));

            try {
                $messaging->send($message);
                Log::info("✅ Firebase notification sent successfully for Client ID={$clientId}");
            } catch (\Throwable $e) {
                Log::error("❌ Firebase notification failed for Client ID={$clientId} - Error: " . $e->getMessage());
            }
        } else {
            Log::warning("⚠️ Client ID={$clientId} does not have a device_token");
        }
    }
}
