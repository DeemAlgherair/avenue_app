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
        Schema::create('advantage_avenue', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advantage_id')->constrained('advantages')->nullable();
            $table->foreignId('avenue_id')->constrained('avenues')->nullable()->onDelete('cascade')->onUpdate('cascade');;
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avenue__advantages');
    }
};
