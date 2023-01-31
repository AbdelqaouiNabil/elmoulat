<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_cheque',
        'id_releverbancaire',
        'date',
        'type',
        'setiation',
        'credit',
        'debit',
       

        
      
        
    ];
}
