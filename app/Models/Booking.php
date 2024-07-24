<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public function customers(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function avenues(){
        return $this->belongsTo(Avenue::class,'avenue_id');
    }
    public function booking_statuses(){
        return $this->belongsTo(Booking_status::class,'status_id');
    }
}
