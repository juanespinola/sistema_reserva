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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('reservation_place_id');  
            $table->date('start_datetime_booking')->nullable();
            $table->date('end_datetime_booking')->nullable();
            $table->timestamps();
        });

        // Schema::table('bookings', function (Blueprint $table) {
        //     $table->after('customer_id');
        // });
    }

   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
