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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('task_id')->constrained('tasks');
            // $table->foreignId('student_id')->constrained('classes');
            $table->string('sumbission_file', 500);
            $table->date('sumbission_date');
            $table->integer('grade');
            $table->text('feedback');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_assignments');
    }
};
