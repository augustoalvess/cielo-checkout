<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pagamento;
use App\Models\PagamentoResposta;
use App\Services\CheckoutService;

class CheckoutController extends Controller {

    public function index() {
        return view('checkout');
    }

    public function checkoutCartaoDeCredito(Request $request) {
        $validator = Validator::make($request->all(), [
            'invoiceid' => 'required',
            'cartaocreditobandeira' => 'required',
            'cartaocreditonumero' => 'required',
            'cartaocreditotitular' => 'required',
            'cartaocreditovalidade' => 'required',
            'cartaocreditocvc' => 'required',
            'pagamentoqtdparcelas' => 'required'
        ], [
            'invoiceid.required' => 'Nao foi identificado nenhum título a ser pago.',
            'cartaocreditobandeira.required' => 'Não foi possível identificar a bandeira do cartão.',
            'cartaocreditonumero.required' => 'O campo "Número do cartão de crédito" é requerido.',
            'cartaocreditotitular.required' => 'O campo "Titular do cartão" é requerido.',
            'cartaocreditovalidade.required' => 'O campo "Validade do cartão" é requerido.',
            'cartaocreditocvc.required' => 'O campo "Dígito de verificação do cartão" é requerido.',
            'pagamentoqtdparcelas.required' => 'O campo "Forma de pagamento" é requerido.'
        ]);
        if ($validator->fails()) {
            $resposta = new PagamentoResposta();
            $resposta->sucesso = false;
            $resposta->mensagemretorno = $validator->errors()->all();
            return view('checkout/checkout', ['resposta' => $resposta]);
        }

        $pagamento = new Pagamento();
        $pagamento->fill($request->all());
        $pagamento->pagamentoid = 1234;
        $pagamento->pagamentovalor = 5.00;
        $pagamento->clienteid = 12345;
        $pagamento->clientenome = 'PESSOA DE TESTE';
        $pagamento->clientecpfcnpj = '';
        $pagamento->clientecep = '';
        $pagamento->clientepais = 'BRA';
        $pagamento->clienteuf = 'RS';
        $pagamento->clientecidade = 'LAJEADO';
        $pagamento->clientebairro = 'CENTRO';
        $pagamento->clientelogradouro = 'AV. TESTE';
        $pagamento->clientenumero = '321';
        $pagamento->clientecomplemento = 'SALA 123';

        $resposta = CheckoutService::pagamentoCartaoDeCredito($pagamento);

        return view('checkout', ['resposta' => $resposta]);
    }
}
