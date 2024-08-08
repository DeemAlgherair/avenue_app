<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advantage extends Model
{
    use HasFactory;
    protected $table ='advantages';

    protected $fillable = [
        'name',
    ];
    public function avenues()
    {
        return $this->belongsToMany(Avenue::class);
    }


}

