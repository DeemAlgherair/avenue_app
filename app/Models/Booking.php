<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public function customers(){
        return $this->belongsTo(Customer::class);
    }
    public function avenues(){
        return $this->belongsTo(Avenue::class);
    }
    public function status(){
        return $this->belongsTo(Booking_status::class);
    }
}
