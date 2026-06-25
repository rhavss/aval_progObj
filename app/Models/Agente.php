<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    protected $table = 'agentes';

    protected $fillable = [
        'nome',
        'funcao',
        'nacionalidade',
        'descricao',
    ];

    public function ultimate()
    {
        return $this->hasOne(Ultimate::class);
    }
}
