var stripe = Stripe('pk_test_51R9O8uFAd1KHqwFqu64T6OMII9gSkauRxShWvIFcogCgbPUy1hsk1wqe46zRCgUzQ1Y6VmKUoxWX0wVCm24DHAwt00DKdPB5uR'); // Usa tu clave pública de Stripe
var elements = stripe.elements();

// Crear un elemento de tarjeta
var card = elements.create('card');
card.mount('#card-element');

// Manejar los errores de la tarjeta
card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Manejar el formulario de envío
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();
    
    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Mostrar error en la interfaz
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Enviar el token al servidor
            var tokenInput = document.createElement('input');
            tokenInput.setAttribute('type', 'hidden');
            tokenInput.setAttribute('name', 'stripeToken');
            tokenInput.setAttribute('value', result.token.id);
            form.appendChild(tokenInput);
            
            form.submit();
        }
    });
});