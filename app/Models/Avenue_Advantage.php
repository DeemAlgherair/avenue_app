<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avenue_Advantage extends Model
{
    
        use HasFactory;
        protected $table ='advantage_avenue';
    
        protected $fillable = [
            'avenue_id',
            'advantage_id',
        ];
        
    }

