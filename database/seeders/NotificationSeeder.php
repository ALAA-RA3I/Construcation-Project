<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // جيب أول 5 مستخدمين (ممكن تعدل العدد)
        $users = User::take(5)->get();

        foreach ($users as $user) {
            for ($i = 1; $i <= 5; $i++) {
                DB::table('notifications')->insert([
                    'id' => Str::uuid(),
                    'type' => 'App\\Notifications\\TestNotification',
                    'notifiable_type' => 'App\Models\Client',
                    'notifiable_id' => 11,
                    'title' => "إشعار تجريبي رقم $i للمستخدم {$user->name}",
                    'data' => json_encode([
                        'message' => "هذا نص تجريبي للإشعار رقم $i",
                        'extra' => 'اختبار النظام'
                    ]),
                    'read_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
