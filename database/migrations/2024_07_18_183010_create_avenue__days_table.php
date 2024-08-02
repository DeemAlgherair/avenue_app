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
        Schema::create('avenue_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('day_id')->constrained('days');
            $table->foreignId('avenue_id')->constrained('avenues')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('status_id')->default(1)->constrained('avenue_day_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avenue__days');
    }
};
