<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_videos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();  // Optional title
            $table->string('original_video');     // Path to the original uploaded video
            $table->string('video_1080p');        // Path to the 1080p transcoded video
            $table->string('video_720p');         // Path to the 720p transcoded video
            $table->string('video_480p');         // Path to the 480p transcoded video
            $table->text('description')->nullable();  // Description of the video
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
