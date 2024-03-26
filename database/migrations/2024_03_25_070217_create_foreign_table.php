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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->enum('role', ['admin', 'siswa', 'guru'])->default('admin');
        });

        Schema::table('assignments', function (Blueprint $table) {
            //
            $table->foreignId('task_id')->constrained('tasks');
            $table->foreignId('student_id')->constrained('classes');
        });

        Schema::table('tasks', function (Blueprint $table) {
            //
            $table->foreignId('course_id')->constrained('courses');
        });

        Schema::table('enrollments', function (Blueprint $table) {
            //
            $table->foreignId('student_id')->constrained('users');
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('class_id')->constrained('classes');
        });

        Schema::table('lessons', function (Blueprint $table) {
            //
            $table->foreignId('course_id')->constrained('courses');
        });

        Schema::table('classes', function (Blueprint $table) {
            //
            $table->foreignId('course_id')->constrained('courses');
        });

        Schema::table('courses', function (Blueprint $table) {
            //
            $table->foreignId('teacher_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foreign');
    }
};
