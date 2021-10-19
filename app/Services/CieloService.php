<?php

namespace App\Services;

use App\Interfaces\CheckoutServiceInterface;
use App\Models\Pagamento;
use App\Models\PagamentoResposta;
use Cielo\API30\Merchant;
use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\Request\CieloRequestException;

class CieloService implements CheckoutServiceInterface {

    public static function pagamentoCartaoDeCredito(Pagamento $pagamento): PagamentoResposta {
        $environment = Environment::sandbox();
        $merchant = new Merchant('MERCHANT ID', 'MERCHANT KEY');

        $sale = new Sale($pagamento->pagamentoid);
        $sale->customer($pagamento->clienteid . ' - ' . $pagamento->clientenome)
            ->setIdentity(str_replace([".", "-", "/"], "", $pagamento->clientecpfcnpj))
            ->setIdentityType((strlen($pagamento->clientecpfcnpj) > 14) ? 'CNPJ' : 'CPF')
            ->address()->setZipCode(str_replace('-', '', $pagamento->clientecep))
            ->setCountry($pagamento->clientepais) // BRA
            ->setState($pagamento->clienteuf)
            ->setCity($pagamento->clientecidade)
            ->setDistrict($pagamento->clientebairro)
            ->setStreet($pagamento->clientelogradouro)
            ->setNumber($pagamento->clientenumero)
            ->setComplement($pagamento->clientecomplemento);

        $payment = $sale->payment(number_format($pagamento->pagamentovalor, 2, '', ''));
        $payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
                ->creditCard($pagamento->cartaocreditocvc, ($pagamento->cartaocreditobandeira != 'mastercard') ?? 'master')
                ->setExpirationDate(str_replace(" ", "", $pagamento->cartaocreditovalidade))
                ->setCardNumber(str_replace(" ", "", $pagamento->cartaocreditonumero))
                ->setHolder($pagamento->cartaocreditotitular);

        try {
            $sale = (new CieloEcommerce($merchant, $environment))->createSale($sale);

            $returnCode = $sale->getPayment()->getReturnCode();
            $returnMessage = $sale->getPayment()->getReturnMessage();
            if (!in_array($returnCode, array('4', '6'))) {
                throw new \Exception($returnCode . ' - ' . $returnMessage);
            }

            $resposta = [
                'sucesso' => true,
                'resposta' => [
                    'paymentId' => $sale->getPayment()->getPaymentId(),
                    'tid' => $sale->getPayment()->getTid(),
                    'paymentDate' => $sale->getPayment()->getReceivedDate()
                ],
                'erroCodigo' => null,
                'erroMensagem' => null
            ];
            return new PagamentoResposta($resposta);
        } catch (CieloRequestException $e) {
            $resposta = [
                'sucesso' => false,
                'resposta' => [],
                'erroCodigo' => $e->getCieloError()->getCode(),
                'erroMensagem' => $e->getCieloError()->getMessage()
            ];
            return new PagamentoResposta($resposta);
        }
    }

}