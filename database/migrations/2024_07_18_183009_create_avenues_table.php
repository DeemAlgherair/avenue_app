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
            $table->string('city')->notNull();
            $table->string('neighborhood')->notNull();
            $table->string('street')->notNull();
            $table->integer('building_number')->notNull();
            $table->decimal('price_per_hours');
            $table->building_number('size')->nullable();
            $table->longText('advantages')->nullable();
            $table->foreignId('owener_id')->constrained('owners')->nullable();
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
