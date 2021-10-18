new Card({
    form: '#checkoutForm',
    container: '.card-wrapper',
    formSelectors: {
        numberInput: 'input#cartaocreditonumero',
        nameInput: 'input#cartaocreditotitular',
        expiryInput: 'input#cartaocreditovalidade',
        cvcInput: 'input#cartaocreditocvc'
    }
});

// Seta a bandeira identificada para o campo hidden 'creditCardType'
document.getElementById('creditcardnumber').addEventListener('payment.cardType', function (event) {
    $('#cartaocreditobandeira').val(event.detail);
});