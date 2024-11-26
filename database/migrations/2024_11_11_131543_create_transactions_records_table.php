<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_record', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key for user_id
            $table->string('course_name'); // Course name
            $table->string('month'); // Month for fee submission
            $table->string('tr_id'); // Fee amount
            $table->string('receipt_url')->nullable(); // Path to the receipt image (nullable in case there's no receipt)
            $table->enum('status', ['paid', 'pending'])->default('pending'); // Status (paid or pending)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions_records');
    }
}
