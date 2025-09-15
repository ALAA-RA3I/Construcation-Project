<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProjectNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('ar_SA');

        for ($i = 0; $i < 10; $i++) { // توليد 20 سجل جديد مثلاً
            DB::table('project_news')->insert([
                'project_id' => $faker->numberBetween(1, 10),
                'path_file' => 'files/news/' . $faker->unique()->regexify('[a-z0-9]{10}') . '.pdf',
                'description' => $faker->sentence(6),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
