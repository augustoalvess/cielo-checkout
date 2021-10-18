<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
<script src="{{ asset('js/app.js') }}" defer></script>

<section class="other_services py-5" id="checkout">
	<div class="container py-lg-5 py-3" style="max-width:100%;margin-top:2%">
		<form action="/checkout/finalizar" method="POST" id="checkoutForm">
			<div class="row">
				<div class="col-md-3 form-group">
				</div>
				<div class="col-md-6 form-group">
                    <!--
					<div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                Mensagem de erro!
                            </div>
                        </div>
					</div>
                    -->
					<div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row" id="creditcard-card">
                                        <div class="col-md-12 form-group">
                                            <div class="row">
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
                                                                <input type="tel" id="cartaocreditonumero" name="cartaocreditonumero" class="form-control border-left-0" required placeholder="Número do cartão de crédito"/>
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
                                                                <input type="text" id="cartaocreditotitular" name="cartaocreditotitular" class="form-control border-left-0" required placeholder="Titular do cartão" autofocus/>
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
                                                                        <i class="fa fa-calculator"></i>
                                                                    </span>
                                                                </span>
                                                                <select id="pagamentoforma" name="pagamentoforma" class="form-control border-left-0" required>
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
                                        </div>
                                    </div>
									<div class="row">
										<div class="col-md-12 form-group">
											<button type="submit" class="btn btn-success" style="width:100%">Confirmar pagamento</button>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>