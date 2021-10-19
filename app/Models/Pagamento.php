<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pagamento {
    use HasFactory;

    protected $fillable = [
        'pagamentoid',
        'cartaocreditobandeira',
        'cartaocreditonumero',
        'cartaocreditotitular',
        'cartaocreditovalidade',
        'cartaocreditocvc',
        'pagamentoforma',
        'pagamentovalor',
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