<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PropertyUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('ar_SA');

        $clientIds = [1, 3, 4];

        for ($i = 0; $i < 20; $i++) { // توليد 40 سجل مثلاً
            DB::table('property_units')->insert([
                'property_book_id' => $faker->numberBetween(1, 10),
                'unit_number' => $faker->unique()->numberBetween(1, 200),
                'floor' => $faker->optional()->numberBetween(1, 20),
                'client_id' => $faker->randomElement($clientIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
