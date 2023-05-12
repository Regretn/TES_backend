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
            ['section_name' => '7-Gold'],
            ['section_name' => '7-Emerald'],
            ['section_name' => '8-Mercury'],
            ['section_name' => '8-Venus'],
            ['section_name' => '9-Aspen'],
            ['section_name' => '9-Birch'],
            ['section_name' => '10-Orchids'],
            ['section_name' => '10-Fold'],
        ];

        DB::table('sections')->insert($section);
    }
}
