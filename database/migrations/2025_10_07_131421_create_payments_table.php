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
            $table->id();
            $table->dateTime('date_time');
            $table->float('total_amount', 10, 2);
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->string('payment_method_name', 255);
            $table->timestamps();
            // $table->foreignId('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            // $table->foreignId('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
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
