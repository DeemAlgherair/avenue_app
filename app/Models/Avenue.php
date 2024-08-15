<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avenue extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'city',
        'neighborhood',
        'street',
        'building_number',
        'price_per_hours',
        'size',
        'advantages',
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
     public function avenueadvantage()
     {
        
            return $this->belongsToMany(Advantage::class);
    }

    
        public function avenues()
    {
        return $this->belongsToMany(Avenue::class,'avenue_days');
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
    public function image()
{
    return $this->hasMany(Avenue_Image::class);
}


}
