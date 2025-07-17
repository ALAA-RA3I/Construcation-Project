<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Domain\Enums\StatusOfSaleEnum;
use App\Domain\Enums\PropertyTypeEnum;
use App\Domain\Enums\ProgressStatusEnum;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Faker::create('ar_SA');

        $statusOfSaleOptions = StatusOfSaleEnum::getValues();
        $typeOptions = PropertyTypeEnum::getValues();
        $progressStatusOptions = ProgressStatusEnum::getValues();

        for ($i = 0; $i < 10; $i++) {
            DB::table('projects')->insert([
                'title' => $faker->sentence(3),
                'project_code' => $faker->unique()->regexify('[A-Z]{3}[0-9]{4}'),
                'description' => $faker->paragraph(3),
                'location' => $faker->city,
                'area' => $faker->numberBetween(500, 5000),
                'number_of_floor' => $faker->optional()->numberBetween(1, 20),
                'status_of_sale' => $faker->randomElement($statusOfSaleOptions),
                'expected_date_of_completed' => $faker->dateTimeBetween('+1 month', '+5 years')->format('Y-m-d'),
                'type' => $faker->randomElement($typeOptions),
                'progress_status' => $faker->randomElement($progressStatusOptions),
                'expected_cost' => $faker->numberBetween(1000000, 50000000),
                'owner_id' => $faker->numberBetween(1, 5),
                'consulting_company_id' => $faker->randomElement([1, 2]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
