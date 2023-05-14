<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $question = [
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],
            ['teacher_question' => 'lorem ipsum'],



        ];

        DB::table('teacher_questions')->insert($question);
    }
}
