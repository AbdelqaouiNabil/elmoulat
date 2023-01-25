<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fdomaine_id',
        'nom',
        'ice',
        'phone',
        'email',
        'adress',
    ];

    public function fdomaine()
    {
        return $this->hasOne(f_domaine::class);
    }
}
