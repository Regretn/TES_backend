<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['user_type' => 'admin'],
            ['user_type' => 'teacher'],
            ['user_type' => 'student'],

        ];

        DB::table('roles')->insert($roles);
    }
}
