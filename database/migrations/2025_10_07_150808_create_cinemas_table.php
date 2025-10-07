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
        Schema::create('cinemas', function (Blueprint $table) {
            $table->id();
            $table->string('type', 30)->comment('1 - Standard | 2 - IMAX | 3 - Directors Club');
            $table->string('hall', 20)->comment('standard 1,2,3... | imax 1,2,3... | directors club 1,2,3...');
            $table->integer('seat_capacity')->default(80);
            $table->string('branch', 50);
            $table->unsignedBigInteger('seat_id');
            $table->timestamps();
            // $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinemas');
    }
};
