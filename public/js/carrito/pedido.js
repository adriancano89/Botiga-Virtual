let stripe = Stripe('pk_test_51R9O8uFAd1KHqwFqu64T6OMII9gSkauRxShWvIFcogCgbPUy1hsk1wqe46zRCgUzQ1Y6VmKUoxWX0wVCm24DHAwt00DKdPB5uR'); // Usa tu clave pública de Stripe
let elements = stripe.elements();

// Crear un elemento de tarjeta
let card = elements.create('card');
card.mount('#card-element');

// Manejar los errores de la tarjeta
card.on('change', function(event) {
    let displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Manejar el formulario de envío
let form = document.getElementById('formPedido');
form.addEventListener('submit', function(event) {
    event.preventDefault();
    
    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Mostrar error en la interfaz
            let errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Enviar el token al servidor
            let tokenInput = document.createElement('input');
            tokenInput.setAttribute('type', 'hidden');
            tokenInput.setAttribute('name', 'stripeToken');
            tokenInput.setAttribute('value', result.token.id);
            form.appendChild(tokenInput);
            
            form.submit();
        }
    });
});