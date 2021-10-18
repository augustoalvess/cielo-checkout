<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Services\CheckoutService;

class CheckoutController extends Controller {

    public function index() {
        return view('checkout');
    }

    public function checkoutCartaoDeCredito(Request $request) {
        $pagamento = new Pagamento($request->all());
        $resposta = CheckoutService::pagamentoCartaoDeCredito($pagamento);

        exit(var_export($resposta));

        return view('checkout');
    }
}
