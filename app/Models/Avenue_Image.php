<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Avenue_Image extends Model
{
    use HasFactory;
    protected $table = 'avenue_images';
    protected $fillable = [
        'url',
        'avenue_id',
        'is_deem',
    ];

    public function avenue()
    {
        return $this->belongsTo(Avenue::class);
    }

  
    
}
