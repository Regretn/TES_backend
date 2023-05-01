<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SectionUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        // $this->call(EvaluationTableSeeder::class);
        $this->call(SectionUserSeeder::class);
    }
}
