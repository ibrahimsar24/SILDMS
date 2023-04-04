<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'admin@test.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Project Manager',
                'email' => 'pm@test.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Sales Manager',
                'email' => 'sm@test.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'HR',
                'email' => 'hr@test.com',
                'password' => Hash::make('12345678'),
            ]
        ]);
    }
}
