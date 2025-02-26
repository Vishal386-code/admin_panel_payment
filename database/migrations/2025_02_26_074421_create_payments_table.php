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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('user_id'); // Foreign key for users
            $table->decimal('amount', 10, 2); // Amount with 2 decimal places
            $table->string('status')->default('pending'); // Payment status
            $table->string('transaction_id')->unique(); // Unique transaction ID
            $table->text('details')->nullable(); // Optional payment details
            $table->timestamps(); // created_at & updated_at

            // Foreign key constraint (Assuming users table exists)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
