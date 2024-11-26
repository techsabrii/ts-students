<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_courses_table.php
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // course_id
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user_id (foreign key)
            $table->string('course_name'); // name of the course
            $table->integer('duration'); // total duration of the course
            $table->text('details'); // description of the course
            $table->json('monthly_fees'); // column to store the fee array as JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
