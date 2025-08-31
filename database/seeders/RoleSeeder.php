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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        Role::truncate();
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
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

            ////////// team ///////////////
            'assign project participant',
            'delete project participant',


            ////////// stages ///////////////
            'view stages',
            'create stages',
            'edit stages',
            'delete stages',

            ////////// tasks ///////////////
            'create tasks',
            'edit tasks',
            'delete tasks',
            'details tasks',
            'add item to task container',
            'delete item to task container',
            'change tasks status',

            ////////// projects resource management ///////////////
            'view reports resource management',
            'view project inventory',
            'add item to inventory',
            'view financial payments',
            'view details payments',
            'add financial payments',


            ////////// diagrams ///////////////
            'view diagrams',
            'download diagrams',
            'upload diagrams',
            'update diagrams',
            'delete diagrams',
            'view archive diagrams',

            ////////// items ////////////
            'view expected items',
            'select expected items',
            'create new items',
            'delete expected items',
            /////////////// Real State Permissions ///////////////
            'view sales project',


            'view ticket',
            'create ticket',
            'change ticket status'
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

                ////////// team ///////////////
                'assign project participant',
                'delete project participant',


                ////////// stages ///////////////
                'view stages',
                'create stages',
                'edit stages',
                'delete stages',

                ////////// tasks ///////////////
                'create tasks',
                'edit tasks',
                'delete tasks',
                'details tasks',
                'add item to task container',
                'delete item to task container',
                'change tasks status',

                ////////// projects resource management ///////////////
                'view reports resource management',
                'view project inventory',
                'add item to inventory',
                'view financial payments',
                'view details payments',
                'add financial payments',


                ////////// diagrams ///////////////
                'view diagrams',
                'download diagrams',
                'upload diagrams',
                'update diagrams',
                'delete diagrams',
                'view archive diagrams',

                ////////// items ////////////
                'view expected items',
                'select expected items',
                'create new items',
                'delete expected items',
                /////////////// Real State Permissions ///////////////
                'view sales project',

            ],
            'projectManager' => [
                /////////////// statistics /////////////
                'view statistics',

                ////////////// user ///////////////
//                'activate user',



                ////////// projects ///////////////
                'view projects',
//                'create projects',
//                'edit projects',
                'details projects',

                ////////// team ///////////////
                'assign project participant',
                'delete project participant',


                ////////// stages ///////////////
                'view stages',
                'create stages',
                'edit stages',
                'delete stages',

                ////////// tasks ///////////////
                'create tasks',
                'edit tasks',
                'delete tasks',
                'details tasks',
                'add item to task container',
                'delete item to task container',
//                'change tasks status',

                ////////// projects resource management ///////////////
                'view reports resource management',
                'view project inventory',
                'add item to inventory',
                'view financial payments',
                'view details payments',
                'add financial payments',


                ////////// diagrams ///////////////
                'view diagrams',
                'download diagrams',
//                'upload diagrams',
//                'update diagrams',
//                'delete diagrams',
                'view archive diagrams',

                ////////// items ////////////
                'view expected items',
//                'select expected items',
//                'create new items',
//                'delete expected items',
                /////////////// Real State Permissions ///////////////
//                'view sales project',

                'view ticket',
                'create ticket',
                'change ticket status'

            ],
            'engineer' => [
                ////////// projects ///////////////
                'view projects',
//                'create projects',
//                'edit projects',
                'details projects',

                ////////// team ///////////////
//                'assign project participant',
//                'delete project participant',


                ////////// stages ///////////////
                'view stages',
//                'create stages',
//                'edit stages',
//                'delete stages',

                ////////// tasks ///////////////
//                'create tasks',
//                'edit tasks',
//                'delete tasks',
                'details tasks',
                'add item to task container',
                'delete item to task container',
                'change tasks status',

                ////////// projects resource management ///////////////
                'view reports resource management',
                'view project inventory',
//                'add item to inventory',
//                'view financial payments',
//                'view details payments',
//                'add financial payments',


                ////////// diagrams ///////////////
                'view diagrams',
                'download diagrams',
//                'upload diagrams',
//                'update diagrams',
//                'delete diagrams',
                'view archive diagrams',

                ////////// items ////////////
                'view expected items',
//                'select expected items',
//                'create new items',
//                'delete expected items',
                /////////////// Real State Permissions ///////////////
//                'view sales project',


                'view ticket',
                'create ticket',
                'change ticket status'
            ],
            'consultingEngineer' => [
                ////////// projects ///////////////
                'view projects',
//                'create projects',
//                'edit projects',
                'details projects',

                ////////// team ///////////////
//                'assign project participant',
//                'delete project participant',


                ////////// stages ///////////////
                'view stages',
//                'create stages',
//                'edit stages',
//                'delete stages',

                ////////// tasks ///////////////
//                'create tasks',
//                'edit tasks',
//                'delete tasks',
                'details tasks',
//                'add item to task container',
//                'delete item to task container',
                'change tasks status',

                ////////// projects resource management ///////////////
                'view reports resource management',
                'view project inventory',
//                'add item to inventory',
                'view financial payments',
                'view details payments',
//                'add financial payments',


                ////////// diagrams ///////////////
                'view diagrams',
                'upload diagrams',
                'update diagrams',
                'delete diagrams',
                'view archive diagrams',

                ////////// items ////////////
                'view expected items',
                'select expected items',
                'create new items',
                'delete expected items',
                /////////////// Real State Permissions ///////////////
//                'view sales project',

                'view ticket',
                'create ticket',
                'change ticket status'
            ],
            'owner' => [
                ////////// projects ///////////////
                'view projects',
//                'create projects',
//                'edit projects',
                'details projects',

                ////////// team ///////////////
//                'assign project participant',
//                'delete project participant',


                ////////// stages ///////////////
                'view stages',
//                'create stages',
//                'edit stages',
//                'delete stages',

                ////////// tasks ///////////////
//                'create tasks',
//                'edit tasks',
//                'delete tasks',
//                'details tasks',
//                'add item to task container',
//                'delete item to task container',
//                'change tasks status',

                ////////// projects resource management ///////////////
                'view reports resource management',
//                'view project inventory',
//                'add item to inventory',
                'view financial payments',
                'view details payments',
//                'add financial payments',


                ////////// diagrams ///////////////
                'view diagrams',
                'download diagrams',
//                'upload diagrams',
//                'update diagrams',
//                'delete diagrams',
                'view archive diagrams',

                ////////// items ////////////
                'view expected items',
//                'select expected items',
//                'create new items',
//                'delete expected items',
                /////////////// Real State Permissions ///////////////
//                'view sales project',
            ],
            'realStateManager' => [
            'view projects',
            'view sales project',
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
