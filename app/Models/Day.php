<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
   
    //pivot table 
    public function avenues()
    {
        return $this->belongsToMany(Avenue::class, 'avenue_days');
    }


   
 
}
