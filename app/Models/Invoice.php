<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public function bookings(){
        return $this->belongsTo(Booking::class,'booking_id');
    }
    public function invoice_statuses(){
        return $this->belongsTo(Invoice_status::class,'status_id');
    }
}
