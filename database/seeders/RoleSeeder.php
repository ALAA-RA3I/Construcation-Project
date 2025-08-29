<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // الصلاحيات المتاحة
        $permissions = [

            /////////////// statistics /////////////
            'view statistics',

            ////////////// user ///////////////
            'activate user',

            ////////// project manager ///////////////
            'view project managers',
            'create project managers',
            'edit project managers',
            'delete project managers',

            ////////// engineers ///////////////
            'view engineers',
            'create engineers',
            'edit engineers',
            'delete engineers',

            ////////// consulting company ///////////////
            'view consulting company',
            'create consulting company',
            'edit consulting company',
            'delete consulting company',
            'profile consulting company',

            ////////// consulting engineers ///////////////
            'view consulting engineers',
            'create consulting engineers',
            'edit consulting engineers',
            'delete consulting engineers',

            ////////// owners ///////////////
            'view owners',
            'create owners',
            'edit owners',
            'delete owners',

            ////////// real estate manager ///////////////
            'view real estate managers',
            'create real estate managers',
            'edit real estate managers',
            'delete real estate managers',

            ////////// projects ///////////////
            'view projects',
            'create projects',
            'edit projects',
            'details projects',
            'assign project engineers',
            'view project department studies',
            'view project department execution',
            'view project resources management',

            ////////// projects resource management ///////////////
            'view reports resource management',
            'export reports resource management',
            'view project container',
            'add project container items',
            'view financial payments',
            'view details payments',
            'add financial payments',

            ////////// stages ///////////////
            'view stages',
            'create stages',
            'edit stages',
            'delete stages',

            ////////// tasks ///////////////
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'done tasks',
            'accept tasks',
            'reject tasks',

            ////////// diagrams ///////////////
            'view diagrams',
            'upload diagrams',
            'update diagrams',
            'delete diagrams',
            'view archive diagrams',

            ////////// items ////////////
            'view items',
            'create items',
            'edit items',
            'delete items',

            ////////// tickets ////////////
            'view tickets',
            'create tickets',
            'change tickets status',

        ];

        // إنشاء الصلاحيات إذا لم تكن موجودة
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // الأدوار مع صلاحياتها
        $rolesWithPermissions = [
            'admin' => [
                /////////////// statistics /////////////
                'view statistics',
                ////////////// user ///////////////
                'activate user',
                ////////// project manager ///////////////
                'view project managers',
                'create project managers',
                'edit project managers',
                'delete project managers',
                'profile project managers',
                ////////// engineers ///////////////
                'view engineers',
                'create engineers',
                'edit engineers',
                'delete engineers',
                'profile engineers',
                ////////// consulting company ///////////////
                'view consulting company',
                'create consulting company',
                'edit consulting company',
                'delete consulting company',
                'profile consulting company',
                ////////// consulting engineers ///////////////
                'view consulting engineers',
                'create consulting engineers',
                'edit consulting engineers',
                'delete consulting engineers',
                'profile consulting engineers',
                ////////// owners ///////////////
                'view owners',
                'create owners',
                'edit owners',
                'delete owners',
                ////////// real estate manager ///////////////
                'view real estate managers',
                'create real estate managers',
                'edit real estate managers',
                'delete real estate managers',
                ////////// projects ///////////////
                'view projects',
                'create projects',
                'edit projects',
                'delete projects',
                'details projects',
                'view project department studies',
                'view project department execution',
                'view project resources management',
                ////////// projects resource management ///////////////
                'view reports resource management',
                'export reports resource management',
                'view project container',
                'view financial payments',
                'view details payments',
                ////////// stages ///////////////
                'view stages',
                ////////// tasks ///////////////
                'view tasks',
                ////////// diagrams ///////////////
                'view diagrams',
                'view archive diagrams',
                ////////// items ////////////
                'view items',

            ],
            'projectManager' => [
                ////////// projects ///////////////
                'view projects',
                'create projects',
                'edit projects',
                'delete projects',
                'details projects',
                'assign project engineers',
                'view project department studies',
                'view project department execution',
                'view project resources management',
                ////////// projects resource management ///////////////
                'view reports resource management',
                'export reports resource management',
                'view project container',
                'add project container items',
                'view financial payments',
                'view details payments',
                'add financial payments',
                ////////// stages ///////////////
                'view stages',
                'create stages',
                'edit stages',
                'delete stages',
                ////////// tasks ///////////////
                'view tasks',
                'create tasks',
                'edit tasks',
                'delete tasks',
                ////////// diagrams ///////////////
                'view diagrams',
                'view archive diagrams',
                ////////// items ////////////
                'view items',
                ////////// tickets ////////////
                'view tickets',
                'create tickets',
                'change tickets status',

            ],
            'engineer' => [
                ////////// projects ///////////////
                'view projects',
                'view project department studies',
                'view project department execution',
                'view project resources management',
                ////////// projects resource management ///////////////
                'view project container',
                ////////// stages ///////////////
                'view stages',
                ////////// tasks ///////////////
                'view tasks',
                'done tasks',
                ////////// diagrams ///////////////
                'view diagrams',
                'view archive diagrams',
                ////////// items ////////////
                'view items',
                ////////// tickets ////////////
                'view tickets',
                'create tickets',
                'change tickets status',

            ],
            'consultingEngineer' => [
                ////////// projects ///////////////
                'view projects',
                'view project department studies',
                'view project department execution',
                'view project resources management',
                ////////// projects resource management ///////////////
                'view reports resource management',
                'view financial payments',
                'view details payments',
                ////////// stages ///////////////
                'view stages',
                ////////// tasks ///////////////
                'view tasks',
                'accept tasks',
                'reject tasks',
                ////////// diagrams ///////////////
                'view diagrams',
                'upload diagrams',
                'update diagrams',
                'delete diagrams',
                'view archive diagrams',
                ////////// items ////////////
                'view items',
                'create items',
                'edit items',
                'delete items',
                ////////// tickets ////////////
                'view tickets',
                'create tickets',
                'change tickets status',

            ],
            'owner' => [
                ////////// projects ///////////////
                'view projects',
                'details projects',
                'view project department execution',
                'view project resources management',
                ////////// projects resource management ///////////////
                'view reports resource management',
                'view financial payments',
                'view details payments',
                ////////// stages ///////////////
                'view stages',
                ////////// tasks ///////////////
                'view tasks',
            ],
            'realStateManager' => [
            'view projects',
            ],

        ];

        foreach ($rolesWithPermissions as $roleName => $rolePermissions) {
            // إنشاء أو تحديث الدور
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);

            // ربط الصلاحيات بالدور
            $role->syncPermissions($rolePermissions);
        }
    }

}
