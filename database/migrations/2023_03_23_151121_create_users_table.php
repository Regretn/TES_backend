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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id')->nullable();
            $table->string('user_name');
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->binary('image')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
