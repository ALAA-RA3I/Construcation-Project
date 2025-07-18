<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PropertyBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('ar_SA');

        // نماذج محتملة للموديل (مثل A، B، C)
        $models = ['A', 'B', 'C', 'D'];

        // اتجاهات محتملة
        $directions = ['شرقي', 'غربي', 'شمالي', 'جنوبي', 'شمالي شرقي', 'شمالي غربي', 'جنوبي شرقي', 'جنوبي غربي'];

        for ($i = 0; $i < 30; $i++) { // توليد 30 سجل
            DB::table('property_books')->insert([
                'project_id' => $faker->numberBetween(1, 10),
                'model' => $faker->randomElement($models),
                'space' => $faker->numberBetween(50, 500), // مساحة بالمتر المربع
                'price' => $faker->randomFloat(2, 50000, 1000000), // سعر بين 50k و 1M
                'description' => $faker->optional()->paragraph(2),
                'payment_period' => $faker->optional()->numberBetween(6, 36), // فترة دفع من 6 إلى 36 شهر

                'number_of_rooms' => $faker->optional()->numberBetween(1, 6),
                'number_of_bathrooms' => $faker->optional()->numberBetween(1, 4),
                'direction' => $faker->optional()->randomElement($directions),
                'diagram_image' => $faker->optional()->regexify('diagrams/[a-z0-9]{10}\.(jpg|png|pdf)'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
