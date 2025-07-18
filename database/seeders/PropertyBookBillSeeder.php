<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Domain\Enums\BookBillTypeEnum;
use Carbon\Carbon;

class PropertyBookBillSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('property_book_bills')->insert([
                [
                    'property_book_id' => $i,
                    'amount' => rand(1000, 5000),
                    'due_in_months' => 0,
                    'type' => BookBillTypeEnum::Monthly,
                    'description' => 'دفعة أولى',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'property_book_id' => $i,
                    'amount' => rand(1000, 5000),
                    'due_in_months' => 1,
                    'type' => BookBillTypeEnum::Monthly,
                    'description' => 'قسط شهري',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]);
        }
    }
}
