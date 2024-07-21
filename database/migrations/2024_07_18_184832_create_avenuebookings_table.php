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
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('serial_no')->notNull();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('avenue_id')->constrained('avenues');
            $table->foreignId('status_id')->constrained('booking_statuses');
            $table->decimal('subtotal');
            $table->decimal('tax')->nullable();
            $table->decimal('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avenuebookings');
    }
};