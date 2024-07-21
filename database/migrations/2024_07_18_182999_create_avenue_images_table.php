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
        Schema::create('avenue_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('images_id')->constrained('images');
            //$table->foreignId('avenue_id')->constrained('avenues');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avenue__images');
    }
};
