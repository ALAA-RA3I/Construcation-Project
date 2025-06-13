<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; // Import Faker for generating fake data
use App\Enums\StatusOfSaleEnum; // Assuming these enums exist in your project
use App\Enums\PropertyTypeEnum;
use App\Enums\ProgressStatusEnum;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
     $faker = Faker::create('ar_SA'); // Create a Faker instance, using Arabic locale for more realistic data if needed

        // The lines to get enum values have been removed as per your request.
        // We will now use default string values directly for the enum fields.

        // Loop to create 10 fake projects
        for ($i = 0; $i < 10; $i++) {
            DB::table('projects')->insert([
                'title' => $faker->sentence(3), // Generates a sentence with 3 words for the title
                'project_code' => $faker->unique()->regexify('[A-Z]{3}[0-9]{4}'), // Generates a unique project code like ABC1234
                'description' => $faker->paragraph(3), // Generates a paragraph with 3 sentences for the description
                'location' => $faker->city, // Generates a city name for the location
                'area' => $faker->numberBetween(500, 5000), // Generates a random area between 500 and 5000
                'number_of_floor' => $faker->numberBetween(1, 20), // Generates a random number of floors between 1 and 20
                'status_of_sale' => 'NotForSale', // Using a default string value for status_of_sale
                'expected_date_of_completed' => $faker->dateTimeBetween('+1 month', '+5 years')->format('Y-m-d'), // Generates a date between 1 month and 5 years from now
                'type' => 'Commercial', // Using a default string value for type
                'progress_status' => 'Initial', // Using a default string value for progress_status
                'expected_cost' => $faker->numberBetween(1000000, 50000000), // Generates a random cost
                'owner_id' => 1, // As requested, set owner_id to 1
                'consulting_company_id' => 1, // As requested, set consulting_company_id to 1
                'created_at' => now(), // Sets the current timestamp for creation
                'updated_at' => now(), // Sets the current timestamp for update
            ]);
        }
    }
    }

