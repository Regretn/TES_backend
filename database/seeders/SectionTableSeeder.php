<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section = [
            ['section_name' => '7-Gold', 'grade' => 7],
            ['section_name' => '7-Emerald', 'grade' => 7],
            ['section_name' => '7-Diamond', 'grade' => 7],
            ['section_name' => '8-Mercury', 'grade' => 8],
            ['section_name' => '8-Venus', 'grade' => 8],
            ['section_name' => '8-Earth', 'grade' => 8],
            ['section_name' => '9-Aspen', 'grade' => 9],
            ['section_name' => '9-Birch', 'grade' => 9],
            ['section_name' => '9-Narra', 'grade' => 9],
            ['section_name' => '10-Orchids', 'grade' => 10],
            ['section_name' => '10-Fold', 'grade' => 10],
            ['section_name' => '10-Lilies', 'grade' => 10],
        ];


        DB::table('sections')->insert($section);
    }
}
