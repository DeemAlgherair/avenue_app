<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Owner extends Authenticatable
{
    protected $table = 'owners';

    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
    public function avenues()
    {
        return $this->Hasmany(Avenue::class,'owener_id');
    }
   
}
