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
            $table->string('comment');
            $table->integer('total_score');
            $table->integer('teacher_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_type');
            $table->boolean('is_evaluated');
            $table->timestamps();
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
