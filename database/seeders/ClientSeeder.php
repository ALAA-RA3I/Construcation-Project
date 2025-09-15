<?php 

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use Carbon\Carbon;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        Client::create([
            'first_name'   => 'Test',
            'last_name'    => 'Client',
            'email'        => 'client@example.com',
            'password'     => Hash::make('password123'),
            'phone_number' => '0501234567',
            // 'national_id'  => 1234567890,
            'is_active'    => true,
            'created_by'   => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
