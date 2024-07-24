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
        Schema::create('avenues', function (Blueprint $table) {
            $table->id();
            $table->string('name')->notNull();
            $table->string('serial_no')->notNull();
            $table->string('location')->notNull();
            $table->decimal('price_per_hours');
            $table->integer('size')->nullable();
            $table->longText('advantages')->nullable();
            $table->foreignId('avenue_day_id')->constrained('days');
            $table->foreignId('image_id')->constrained('images');
            $table->foreignId('owener_id')->constrained('owners');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avenues');
    }
};
