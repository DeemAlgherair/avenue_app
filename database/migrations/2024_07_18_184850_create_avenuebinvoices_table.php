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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->notNull();
            $table->foreignId('booking_id')->constrained('bookings');
            $table->foreignId('status_id')->constrained('invoice_statuses');
            $table->date('creation_date')->notNull();
            $table->date('end_date')->notNull();
            $table->string('invoice_file')->notNull();
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
        Schema::dropIfExists('avenuebinvoices');
    }
};
