<?php

namespace App\Interfaces;

use App\Models\Pagamento;
use App\Models\PagamentoResposta;

interface CheckoutServiceInterface {
    public static function pagamentoCartaoDeCredito(Pagamento $pagamento): PagamentoResposta;
}
