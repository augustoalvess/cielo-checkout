<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
<script src="{{ asset('js/app.js') }}" defer></script>

<section class="py-5" id="checkout">
	<div class="container-fluid">

        @if (isset($resposta->sucesso) && !$resposta->sucesso)
            <div class="row justify-content-center mb-3">
                <div class="col-md-8">
                    <div class="alert alert-danger" role="alert">
                        @if (is_array($resposta->mensagemretorno))
                            @foreach ($resposta->mensagemretorno as $erro)
                                {{$erro}} <br>
                            @endforeach
                        @else
                            {{$resposta->codigoretorno}} - {{$resposta->mensagemretorno}}
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @if (isset($resposta->sucesso) && $resposta->sucesso)
            <div class="row justify-content-center mb-3">
                <div class="col-md-8">
                    <div class="alert alert-success" role="alert">
                        {{$resposta->codigoretorno}} - {{$resposta->mensagemretorno}}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-right">
                            <div class="col-md-2 form-group">
                                <a href="/" class="btn btn-info"><i class="fas fa-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                        <form action="/checkout/finalizar" method="POST" id="checkoutForm" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class='row'>
                                <div class='col-md-12'>
                                    <div class='alert alert-secondary' role='alert'>
                                        <b><input type='radio' id='invoiceid' name='invoiceid' checked value='' checked> (Cód) - (Descrição) - R$ (Valor)  @if (1 > 0) <span class="badge badge-danger p-2">EM ABERTO</span> @else <span class="badge badge-success p-2">QUITADO</span> @endif</b>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="creditcard-card">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="input-group">
                                                <span class="input-group-prepend bg-white border-right-0">
                                                    <span class="input-group-text bg-transparent">
                                                        <i class="fa fa-credit-card"></i>
                                                    </span>
                                                </span>
                                                <input type="hidden" id="cartaocreditobandeira" name="cartaocreditobandeira"/>
                                                <input type="tel" id="cartaocreditonumero" name="cartaocreditonumero" class="form-control border-left-0" required placeholder="Número do cartão de crédito" autofocus/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="input-group">
                                                <span class="input-group-prepend bg-white border-right-0">
                                                    <span class="input-group-text bg-transparent">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                </span>
                                                <input type="text" id="cartaocreditotitular" name="cartaocreditotitular" class="form-control border-left-0" required placeholder="Titular do cartão"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <div class="input-group">
                                                <span class="input-group-prepend bg-white border-right-0">
                                                    <span class="input-group-text bg-transparent">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </span>
                                                <input type="tel" id="cartaocreditovalidade" name="cartaocreditovalidade" class="form-control border-left-0" required placeholder="MM/AAAA"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <div class="input-group">
                                                <span class="input-group-prepend bg-white border-right-0">
                                                    <span class="input-group-text bg-transparent">
                                                        <i class="fa fa-lock"></i>
                                                    </span>
                                                </span>
                                                <input type="text" id="cartaocreditocvc" name="cartaocreditocvc" class="form-control border-left-0" required placeholder="CVC"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="input-group">
                                                <span class="input-group-prepend bg-white border-right-0">
                                                    <span class="input-group-text bg-transparent">
                                                        <b>R$</b>
                                                    </span>
                                                </span>
                                                <select id="pagamentoqtdparcelas" name="pagamentoqtdparcelas" class="form-control border-left-0" required>
                                                    <option value="1">À VISTA</option>
                                                    <option value="2">2x</option>
                                                    <option value="3">3x</option>
                                                    <option value="4">4x</option>
                                                    <option value="5">5x</option>
                                                    <option value="6">6x</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-wrapper"></div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-success" style="width:100%">Confirmar pagamento</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>