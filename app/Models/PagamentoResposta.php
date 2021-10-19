<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PagamentoResposta {
    use HasFactory;

    protected $fillable = [
        'sucesso',
        'resposta',
        'errocodigo',
        'erromensagem'
    ];
}