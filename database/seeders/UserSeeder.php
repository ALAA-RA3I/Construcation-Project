<?php

namespace Database\Seeders;

use App\Domain\Enums\UserStatusEnum;
use App\Models\ConsultingEngineer;
use App\Models\Engineer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => Hash::make('password'),
                'phone_number' => '1234567890',
                'is_active' => 1,
            ]
        );
        $admin->assignRole('admin');

        // Create or update Engineers
        for ($i = 1; $i <= 10; $i++) {
            $user = User::updateOrCreate(
                ['email' => "engineer{$i}@example.com"],
                [
                    'first_name' => "Engineer{$i}",
                    'last_name' => "Lastname{$i}",
                    'password' => Hash::make('password'),
                    'phone_number' => '050000000' . $i,
                    'is_active' => 1,
                ]
            );
            $user->assignRole('engineer');

            Engineer::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'years_of_experience' => rand(1, 10),
                    'engineer_specialization_id' => 1,
                ]
            );
        }

        // Create or update Consulting Engineers
        for ($i = 1; $i <= 10; $i++) {
            $user = User::updateOrCreate(
                ['email' => "consultingengineer{$i}@example.com"],
                [
                    'first_name' => "ConsultingEngineer{$i}",
                    'last_name' => "Lastname{$i}",
                    'password' => Hash::make('password'),
                    'phone_number' => '050000001' . $i, // changed a bit to avoid same phone
                    'is_active' => 1,
                ]
            );
            $user->assignRole('consultingEngineer');

            ConsultingEngineer::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'consulting_company_id' => rand(1, 2),
                    'engineer_specialization_id' => 1,
                ]
            );
        }
    }
}
