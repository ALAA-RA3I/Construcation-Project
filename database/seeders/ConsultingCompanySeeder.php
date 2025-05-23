<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('consulting_companies')->updateOrInsert(
            ['email' => 'info@visionconsultants.com'], // unique column to check
            [
                'name' => 'Vision Consultants',
                'focal_point_first_name' => 'Ahmed',
                'focal_point_last_name' => 'Khaled',
                'address' => '123 Nile Street, Cairo, Egypt',
                'phone_number' => "201237890",
                'land_line' => 2023456789,
                'license_number' => 567890,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]
        );

        DB::table('consulting_companies')->updateOrInsert(
            ['email' => 'contact@futureadvisory.org'],
            [
                'name' => 'Future Advisory',
                'focal_point_first_name' => 'Salma',
                'focal_point_last_name' => 'Hassan',
                'address' => '45 Smart Village, Giza, Egypt',
                'phone_number' => "2098765432",
                'land_line' => 2029876543,
                'license_number' => 123456,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]
        );
    }
}
