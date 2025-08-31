<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification as BaseNotification;

class UserInstallmentNotification extends BaseNotification implements ShouldQueue
{
    use Queueable;

    public string $title;
    public string $body;

    public function __construct(string $title, string $body)
    {
        $this->title = $title;
        $this->body  = $body;
    }

    /**
     * قنوات الإرسال
     */
    public function via(object $notifiable): array
    {
        // نخزن بالداتابيز + نبعت فايربيز
        return ['database', 'fcm'];
    }

    /**
     * البيانات يلي تنخزن بالداتابيز
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'body'  => $this->body,
        ];
    }

    /**
     * قنوات فايربيز (custom channel)
     */
    public function toFcm(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'body'  => $this->body,
            'token' => $notifiable->fcm_token, // لازم يكون موجود بجدول clients
        ];
    }
}
