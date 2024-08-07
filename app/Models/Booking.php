<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// app/Models/Booking.php

class Booking extends Model
{
    use HasFactory;
    //use SoftDeletes;

     use SoftDeletes;
    protected $fillable = [
        'serial_no',
        'booking_date',
        'customer_id',
        'avenue_id',
        'status_id',
        'startDate', 
        'endDate',
        'subtotal',
        'tax',
        'total',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function avenues()
    {
        return $this->belongsTo(Avenue::class,'avenue_id');
    }

    public function status()
    {
        return $this->belongsTo(Booking_status::class, 'status_id');
    }
    public function booking_statuses()
    {
        return $this->belongsTo(Booking_status::class, 'status_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function avenue()
{
    return $this->belongsTo(Avenue::class, 'avenue_id');
}
public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

}
