<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avenue_Day_Status extends Model
{
    use HasFactory;
        protected $table = 'avenue_day_status';


    public function avenueDay()
    {
        return $this->hasMany(Avenue_Day::class);
    }
}
