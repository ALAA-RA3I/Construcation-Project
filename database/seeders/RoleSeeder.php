<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'engineer',
            'consultingEngineer',
            'owner',
            'admin',
            'realStateManager',
        ];

        foreach ($roles as $name) {
            DB::table('roles')->updateOrInsert([
                'name' => $name,
                'guard_name' => 'web'
            ]);
        }
    }
}
