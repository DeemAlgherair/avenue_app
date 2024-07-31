<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avenue extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'location',
        'price_per_hours',
        'size',
        'advantages',
        'image_id',
        'serial_no',
        'owener_id',
    ];


    // protected $guarded;
    public function owner()
    {
        return $this->belongsTo(Owner::class,'owener_id');
    }
    
     //pivot table
     public function days()
     {
         return $this->belongsToMany(Day::class, 'avenue_days');
     }
    /*
    public function days()
    {
        return $this->hasOneThrough(Day::class, Avenue_Day::class,'id', 'id', 'avenue_day_id', 'day_id');
    }
        */
        /*public function day()
        {
            return $this->belongsTo(Day::class,'avenue_day_id');
        }*/

        public function avenues()
    {
        return $this->belongsToMany(Avenue::class,'avenue_days');
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
    public function owners()
    {
        return $this->belongsTo(Owner::class,'owener_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);

    }

}
