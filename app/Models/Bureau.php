<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bureau extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'ville',
        'phone',
        
    ];
}
