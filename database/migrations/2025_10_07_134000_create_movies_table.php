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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('rating', 10)->comment('1 - G | 2 - PG | 3 - R-13 | 4 - R-16 | 5 - R-18');
            $table->string('duration');
            $table->string('genre')->nullable();
            $table->text('synopsis')->nullable();
            $table->string('poster')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
