<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $question = [
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],
            ['student_question' => 'lorem ipsum'],



        ];

        DB::table('student_questions')->insert($question);
    }
}
