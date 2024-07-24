<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avenue extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'avenue_day_id',
        'location',
        'price_per_hours',
        'size',
        'advantages',
        'image_id',
        'serial_no',
    ];


    // protected $guarded;
    public function owner()
    {
        return $this->belongsTo(Owner::class,'owener_id');
    }
    /*
    public function days()
    {
        return $this->hasOneThrough(Day::class, Avenue_Day::class,'id', 'id', 'avenue_day_id', 'day_id');
    }
        */
        public function days()
        {
            return $this->belongsTo(Day::class,'avenue_day_id');
        }
    /*
    public function image()
    {
        return $this->hasOneThrough(
            Image::class, 
            Avenue_Image::class, 
            'id', 
            'id', 
            'image_id',
            'images_id');
        }
    */
    public function image()
    {
        return $this->belongsTo(Image::class);

    }

        public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
