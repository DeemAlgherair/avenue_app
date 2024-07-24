<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avenue_Day extends Model
{
    use HasFactory;
    protected $table = 'avenue_days';
    public function days()
    {
        return $this->belongsTo(Day::class);
    }

    public function avenues()
    {
        return $this->hasMany(Avenue::class);
    }
}
