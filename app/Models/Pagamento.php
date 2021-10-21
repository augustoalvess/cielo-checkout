<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model {

    protected $fillable = [
        'pagamentoid',
        'cartaocreditobandeira',
        'cartaocreditonumero',
        'cartaocreditotitular',
        'cartaocreditovalidade',
        'cartaocreditocvc',
        'pagamentoforma',
        'pagamentovalor',
        'pagamentoqtdparcelas',
        'clienteid',
        'clientenome',
        'clientecpfcnpj',
        'clientecep',
        'clientepais',
        'clienteuf',
        'clientecidade',
        'clientebairro',
        'clientelogradouro',
        'clientenumero',
        'clientecomplemento'
    ];
}