<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserPropertyUnitInstallmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إعداد بيانات مخصصة
        $clientIds = [1, 3, 4];
        $billIds = range(1, 20);
        $unitIds = range(1, 20);

        foreach ($unitIds as $unitId) {
            // عدد الأقساط لكل وحدة، مثلاً 2
            for ($i = 0; $i < 2; $i++) {
                DB::table('user_property_unit_installments')->insert([
                    'property_unit_id' => $unitId,
                    'client_id' => $clientIds[array_rand($clientIds)],
                    'amount' => rand(500, 5000),
                    'due_date' => Carbon::now()->addMonths(rand(0, 12))->format('Y-m-d'),
                    'is_paid' => (bool) rand(0, 1),
                    'property_book_bill_id' => $billIds[array_rand($billIds)],
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
