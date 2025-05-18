<?php

namespace Database\Seeders;

use App\Domain\Enums\UserStatusEnum;
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
        // Create Admin User
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone_number' => '1234567890',
            'status' => 'active',
        ]);
        $admin->assignRole('admin');

        // Create 10 Engineers
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'first_name' => "Engineer{$i}",
                'last_name' => "Lastname{$i}",
                'email' => "engineer{$i}@example.com",
                'password' => Hash::make('password'),
                'phone_number' => '050000000' . $i,
                'status' => UserStatusEnum::Active,
            ]);
            $user->assignRole('engineer');

            Engineer::create([
                'user_id' => $user->id,
                'years_of_experience' => rand(1, 10),
                'engineer_specialization_id' => 1, // make sure specialization ID 1 exists
            ]);
        }
    }
}
