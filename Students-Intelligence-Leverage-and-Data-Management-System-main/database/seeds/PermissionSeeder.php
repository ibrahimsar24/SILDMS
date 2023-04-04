<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'manage_attendance',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage_role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage_permission',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage_user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage_sales',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage_projects',
                'guard_name' => 'web',
            ]
        ]);
    }
}
