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
        $environment = Environment::sandbox(); // Environment::production()
        $merchant = new Merchant('56a04a20-7b2c-487d-8d68-4c90f467944a', 'KIYXUODITXFRORETIVUWYKTKSXIEWGHRJGRFASCU'); // 'MERCHANT ID', 'MERCHANT KEY'

        $sale = new Sale($pagamento->pagamentoid);
        $sale->customer($pagamento->clienteid . ' - ' . $pagamento->clientenome)
            ->setIdentity(str_replace([".", "-", "/"], "", $pagamento->clientecpfcnpj))
            ->setIdentityType((strlen($pagamento->clientecpfcnpj) > 14) ? 'CNPJ' : 'CPF')
            ->address()->setZipCode(str_replace('-', '', $pagamento->clientecep))
            ->setCountry($pagamento->clientepais)
            ->setState($pagamento->clienteuf)
            ->setCity($pagamento->clientecidade)
            ->setDistrict($pagamento->clientebairro)
            ->setStreet($pagamento->clientelogradouro)
            ->setNumber($pagamento->clientenumero)
            ->setComplement($pagamento->clientecomplemento);

        $payment = $sale->payment(number_format($pagamento->pagamentovalor, 2, '', ''), $pagamento->pagamentoqtdparcelas);
        $payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
                ->creditCard($pagamento->cartaocreditocvc, ($pagamento->cartaocreditobandeira != 'mastercard') ? $pagamento->cartaocreditobandeira : 'master')
                ->setExpirationDate(str_replace(" ", "", $pagamento->cartaocreditovalidade))
                ->setCardNumber(str_replace(" ", "", $pagamento->cartaocreditonumero))
                ->setHolder($pagamento->cartaocreditotitular);

        try {
            $sale = (new CieloEcommerce($merchant, $environment))->createSale($sale);

            $returnCode = $sale->getPayment()->getReturnCode();
            $returnMessage = $sale->getPayment()->getReturnMessage();
            if (!in_array($returnCode, array('0', '00', '000'))) {
                throw new CieloRequestException($returnMessage, $returnCode);
            }

            (new CieloEcommerce($merchant, $environment))->captureSale($sale->getPayment()->getPaymentId());

            $resposta = [
                'sucesso' => true,
                'resposta' => [
                    'paymentid' => $sale->getPayment()->getPaymentId(),
                    'tid' => $sale->getPayment()->getTid(),
                    'paymentdate' => $sale->getPayment()->getReceivedDate()
                ],
                'codigoretorno' => $returnCode,
                'mensagemretorno' => $returnMessage
            ];
            $respostaPagamento = new PagamentoResposta();
            $respostaPagamento->fill($resposta);

            return $respostaPagamento;

        } catch (CieloRequestException $e) {
            $resposta = [
                'sucesso' => false,
                'resposta' => [],
                'codigoretorno' => !empty($e->getCieloError()) ? $e->getCieloError()->getCode() : $e->getCode(),
                'mensagemretorno' => !empty($e->getCieloError()) ? $e->getCieloError()->getMessage() : $e->getMessage()
            ];
            $respostaPagamento = new PagamentoResposta();
            $respostaPagamento->fill($resposta);

            return $respostaPagamento;
        }
    }

}