<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    // nome da tabela no banco (o laravel ja adivinharia certo, mas deixo explicito pra ficar claro)
    protected $table = 'agentes';

    // campos que podem ser preenchidos pelo formulario
    protected $fillable = [
        'nome',
        'funcao',
        'nacionalidade',
        'descricao',
    ];

    // um agente pode ter uma ultimate associada a ele
    public function ultimate()
    {
        return $this->hasOne(Ultimate::class);
    }
}
