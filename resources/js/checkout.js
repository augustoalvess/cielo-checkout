new Card({
    form: '#checkoutForm',
    container: '.card-wrapper',
    formSelectors: {
        numberInput: 'input#cartaocreditonumero',
        nameInput: 'input#cartaocreditotitular',
        expiryInput: 'input#cartaocreditovalidade',
        cvcInput: 'input#cartaocreditocvc'
    },
    placeholders: {
        number: '•••• •••• •••• ••••',
        name: 'Nome titular',
        expiry: '••/••••',
        cvc: '•••'
    }
});

// Seta a bandeira identificada para o campo hidden 'cartaocreditobandeira'
document.getElementById('cartaocreditonumero').addEventListener('payment.cardType', function (event) {
    if (event.detail != 'unknown') {
        $('#cartaocreditobandeira').val(event.detail);
    }
});