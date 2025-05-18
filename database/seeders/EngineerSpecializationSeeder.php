<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EngineerSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = [
            'Civil Engineering',
            'Electrical Engineering',
            'Mechanical Engineering',
            'Architectural Engineering',
            'Computer Engineering',
            'Environmental Engineering',
            'Industrial Engineering',
            'Structural Engineering',
            'Geotechnical Engineering',
            'Chemical Engineering',
        ];

        foreach ($specializations as $name) {
            DB::table('engineer_specializations')->insert([
                'name_of_major' => $name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
