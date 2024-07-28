<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'rate',
        'comment',
        'customer_id',
        'avenue_id',
        'booking_id',
    ];

    public function user()
    {
        return $this->belongsTo(Customer::class);
    }

    public function avenue()
    {
        return $this->belongsTo(Avenue::class);
    }
}
