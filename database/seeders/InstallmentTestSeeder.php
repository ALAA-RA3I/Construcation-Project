<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\UserPropertyUnitInstallments;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class InstallmentTestSeeder extends Seeder
{
    public function run(): void
    {
        // // 1. أنشئ عميل للتجربة
        // $client = Client::create([

        //     'first_name' => 'John',
        //     'last_name' => 'Doe',
        //     'email' => 'moayad22222.harmoush@gmail.com',
        //     'password' => Hash::make('password123'),
        //     'phone_number' => '+1234567890',
        //     // 'national_id' => 123456789012345,
        //     'api_token' => \Illuminate\Support\Str::random(60),
        //     'is_active' => true,


        //     'device_token' => 'ضع_هنا_التوكن_الخاص_بفايربيز_للتجريب'
        // ]);

        // 2. أنشئ أقساط بثلاث حالات
       $clienrId=12;
        // قسط رح يستحق بعد 3 أيام (داخل فترة dueSoon)
        UserPropertyUnitInstallments::create([
            'property_unit_id' => 11,
            'client_id' =>$clienrId,
            'due_date' => Carbon::today()->addDays(3),
            'is_paid' => false,
        ]);

        // قسط متأخر يوم واحد
        UserPropertyUnitInstallments::create([
            'property_unit_id' => 11,
            'client_id' => $clienrId,
            'due_date' => Carbon::today()->subDay(),
            'is_paid' => false,
        ]);

        // قسط متأخر 10 أيام
        UserPropertyUnitInstallments::create([
            'property_unit_id' => 11,
            'client_id' => $clienrId,
            'due_date' => Carbon::today()->subDays(10),
            'is_paid' => false,
        ]);
    }
}
