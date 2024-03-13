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
        Schema::create('transactions_inventories', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', ['entry', 'withdrawal', 'adjustment', 'transfer']);
            $table->unsignedBigInteger('product_id');
            $table->integer('affected_quantity');
            $table->string('source_location')->nullable();
            $table->string('destination_location')->nullable();
            $table->dateTime('transaction_date_time');
            $table->unsignedBigInteger('user_id');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions_inventories');
    }
};
