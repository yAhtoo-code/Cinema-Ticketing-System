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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('movie_id');
            $table->string('movie_title', 100);
            $table->string('seats')->nullable();
            $table->dateTime('date_time');
            // $table->float('total_amount', 10, 2);
            $table->timestamps();
            // $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreignId('movie_id')->references('id')->on('movies')->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
