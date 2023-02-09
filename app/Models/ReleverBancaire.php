<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleverBancaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'compte_id',
        'date',
        // 'operation_ref',

    ];
}
