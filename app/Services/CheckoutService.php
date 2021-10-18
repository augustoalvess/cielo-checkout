<?php

namespace App\Services;

use App\Interfaces\CheckoutServiceInterface;
use App\Models\Pagamento;
use App\Models\PagamentoResposta;

class CheckoutService implements CheckoutServiceInterface {

    public static function pagamentoCartaoDeCredito(Pagamento $pagamento): PagamentoResposta {
        return CieloService::pagamentoCartaoDeCredito($pagamento);
    }

}