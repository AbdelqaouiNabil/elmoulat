<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bureau_id',
        'nom',
        'prenom',
        'phone',
        'datedubet',
        'contrat',
        'designiation',
        'salaire'
    ];
}
