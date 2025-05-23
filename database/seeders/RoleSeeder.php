<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'engineer']);
        Role::create(['name' => 'consultingEngineer']);
        Role::create(['name' => 'owner']);
        Role::create(['name' => 'admin']); // Optional
        Role::create(['name' => 'realStateManager']); // Optional
    }
}
