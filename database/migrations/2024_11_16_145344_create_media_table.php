<?php

// database/migrations/xxxx_xx_xx_create_media_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('course_name');
            $table->string('image_path');
            $table->string('video_path');
            $table->string('encrypted_video_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
}

