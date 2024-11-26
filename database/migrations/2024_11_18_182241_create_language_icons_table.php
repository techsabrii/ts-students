<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('language_icons', function (Blueprint $table) {
            $table->id();
            $table->string('language_name')->unique();
            $table->string('icon_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('language_icons');
    }
};
