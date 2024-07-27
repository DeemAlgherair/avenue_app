<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Booking_status.php

class Booking_status extends Model
{
    use HasFactory;

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'status_id');
    }
}

