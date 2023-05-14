<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $question = [
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],
            ['admin_question' => 'lorem ipsum'],



        ];

        DB::table('admin_questions')->insert($question);
    }
}
