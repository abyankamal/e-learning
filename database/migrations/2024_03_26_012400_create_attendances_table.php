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
        Schema::create('attendances', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->constrained('users');
            $table->string('latitude', 20);
            $table->string('longitude', 20);
            $table->string('address', 500);
            $table->dateTime('attendance_date');
            $table->dateTime('attendance_time');
            $table->dateTime('expected_time')->nullable();
            $table->enum('status', ['attend', 'sick', 'leave']);
            $table->string('description', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigments');
    }
};
