<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagamentoResposta extends Model {

    protected $fillable = [
        'sucesso',
        'resposta',
        'codigoretorno',
        'mensagemretorno'
    ];
}