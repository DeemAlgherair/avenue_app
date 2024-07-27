<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avenue_Day extends Model
{
    use HasFactory;
    protected $table ='avenue_days';

    protected $fillable = [
        'avenue_id',
        'day_id',
    ];
    public function status(){
        return $this->belongsTo(Avenue_Day_Status::class,'status_id');
    }

}
