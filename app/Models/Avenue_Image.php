<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Avenue_Image extends Model
{
    use HasFactory;
    protected $table='avenue_images';
    protected $fillable = [
        'url',
        'avenue_id',
        'is_main',
    ];

    public function avenue()
    {
        return $this->belongsToMany(Avenue::class,'avenue_id');
    }

    
}
