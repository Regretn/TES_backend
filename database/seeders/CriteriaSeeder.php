<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criteria = [
            ['criteria_name' => 'APPEARANCE AND PERSONAL PRESENTATION'],
            ['criteria_name' => 'PROFESSIONAL PRACTICES'],
            ['criteria_name' => 'TEACHING METHODS'],
            ['criteria_name' => 'NATERIALS AND DELIVERY'],



        ];

        DB::table('criterias')->insert($criteria);
    }
}
