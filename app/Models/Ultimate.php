<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ultimate extends Model
{
    protected $table = 'ultimates';

    protected $fillable = [
        'agente_id',
        'preco_orbes',
        'descricao',
    ];

    public function agente()
    {
        return $this->belongsTo(Agente::class);
    }
}
