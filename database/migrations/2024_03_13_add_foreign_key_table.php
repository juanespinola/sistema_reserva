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
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('reservation_place_id')->references('id')->on('reservation_places')->onDelete('cascade'); 
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('reservation_place_id')->references('id')->on('reservation_places')->onDelete('cascade');           
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });

        Schema::table('purchases_detail', function (Blueprint $table) {
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('reservation_place_id')->references('id')->on('reservation_places')->onDelete('cascade');
        });

        Schema::table('sales_detail', function (Blueprint $table) {
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('transactions_inventories', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->comments('Usuario Responsable');
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['customer_id', 'reservation_place_id']);
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['customer_id', 'reservation_place_id']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
        });

        Schema::table('sales_detail', function (Blueprint $table) {
            $table->dropForeign(['sale_id', 'product_id']);
        });

        Schema::table('purchases_detail', function (Blueprint $table) {
            $table->dropForeign(['purchase_id', 'product_id']);
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->dropForeign(['customer_id', 'reservation_place_id']);
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::table('transactions_inventories', function (Blueprint $table) {
            $table->dropForeign(['product_id', 'user_id']);
        });
    }
};
