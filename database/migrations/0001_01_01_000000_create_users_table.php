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
        // Create the 'users' table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->nullable();
            $table->string('student_name')->nullable();
            $table->string('father_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nic')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('home_address')->nullable();
            $table->string('contact')->nullable();
            $table->string('education')->nullable();
            $table->string('gender')->nullable();
            $table->string('subject')->nullable();
            $table->text('decs')->nullable();
            $table->string('github')->nullable();
            $table->string('status')->nullable();
            $table->string('image_path')->nullable();
            $table->string('last_result_img')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('reg_status')->default(false);
            $table->timestamp('reg_date')->nullable();
            $table->boolean('stealth_mode')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        // Create the 'password_reset_tokens' table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Create the 'sessions' table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');  // Foreign key constraint
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
