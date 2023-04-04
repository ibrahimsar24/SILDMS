<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_roles')->insert([
            [
                'role_id' => '1',
                'model_type' => 'App\User',
                'model_id' => '1'
            ],
            [
                'role_id' => '2',
                'model_type' => 'App\User',
                'model_id' => '4'
            ],
            [
                'role_id' => '3',
                'model_type' => 'App\User',
                'model_id' => '2'
            ],
            [
                'role_id' => '4',
                'model_type' => 'App\User',
                'model_id' => '3'
            ]
        ]);
    }
}
