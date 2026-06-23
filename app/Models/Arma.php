<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arma extends Model
{
    protected $table = 'armas';

    protected $fillable = [
        'nome',
        'classe',
        'preco',
    ];
}
