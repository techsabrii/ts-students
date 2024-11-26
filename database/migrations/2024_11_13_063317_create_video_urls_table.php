<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoUrlsTable extends Migration
{
    public function up()
    {
        Schema::create('video_urls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('video_id');
            $table->string('video_url');
            $table->timestamp('expires_at');
            $table->boolean('used')->default(false);
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_urls');
    }
}
