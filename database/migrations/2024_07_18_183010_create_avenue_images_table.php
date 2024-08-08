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
            $table->string('url')->notNull();
<<<<<<< HEAD
            $table->foreignId('avenue_id')->constrained('avenues')->onDelete('cascade')->onUpdate('cascade');
=======
            $table->foreignId('avenue_id')->constrained('avenues')->onDelete('restrict')->onUpdate('cascade');
>>>>>>> 2efb48683cbab543e6b5ccf766db9866186d6380
            $table->boolean('is_main')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avenue_images');
    }
};
