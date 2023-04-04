<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_has_permissions')->insert([
            [
                'permission_id' => '4',
                'role_id' => '2',
            ],
            [
                'permission_id' => '5',
                'role_id' => '2',
            ],
            [
                'permission_id' => '5',
                'role_id' => '4',
            ],
            [
                'permission_id' => '6',
                'role_id' => '2',
            ],
            [
                'permission_id' => '6',
                'role_id' => '3',
            ]
        ]);
    }
}
