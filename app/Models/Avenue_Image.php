<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Avenue_Image extends Model
{
    use HasFactory;
    protected $table = 'avenue_images';
    protected $fillable = [
        'images_id',
    ];

    public function avenue()
    {
        return $this->belongsTo(Avenue::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    
}
