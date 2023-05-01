<?php

namespace Database\Seeders;

use App\Models\SectionUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SectionUser::factory()->count(96)->create();
    }
}
