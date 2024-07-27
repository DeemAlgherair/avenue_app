<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Booking.php

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_no',
        'booking_date',
        'customer_id',
        'avenue_id',
        'status_id',
        'subtotal',
        'tax',
        'total',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function avenue()
    {
        return $this->belongsTo(Avenue::class, 'avenue_id');
    }

    public function status()
    {
        return $this->belongsTo(Booking_status::class, 'status_id');
    }
}
