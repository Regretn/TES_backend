<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->integer('q1');
            $table->integer('q2');
            $table->integer('q3');
            $table->integer('q4');
            $table->integer('q5');
            $table->integer('q6');
            $table->integer('q7');
            $table->integer('q8');
            $table->integer('q9');
            $table->integer('q10');
            $table->integer('q11');
            $table->integer('q12');
            $table->integer('q13');
            $table->integer('q14');
            $table->integer('q15');
            $table->integer('q16');
            $table->integer('q17');
            $table->integer('q18');
            $table->integer('q19');
            $table->integer('q20');
            $table->string('comment')->nullable();
            $table->integer('total_score');
            $table->integer('teacher_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('user_type');
            $table->foreign('user_type')->references('id')->on('roles');
            $table->unique(['user_id', 'student_id', 'year']);
            $table->unique(['user_id', 'teacher_id', 'year']);
            $table->timestamps();
            $table->integer('year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
