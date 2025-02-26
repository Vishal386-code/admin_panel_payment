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
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('transaction_id'); // Remove transaction_id
            $table->string('account_name')->after('status'); // Add account_name after status
            $table->string('source')->nullable()->after('account_name'); // Add source after account_name
            $table->string('client_name')->nullable()->after('source'); // Add client_name after source
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['account_name', 'source', 'client_name']); // Remove new columns
            $table->string('transaction_id')->unique()->after('status'); // Add back transaction_id
        });
    }
};
