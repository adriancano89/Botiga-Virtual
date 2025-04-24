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

function validarCarrito() {
    let errores = [];
    let carritoItems = document.querySelectorAll('.producto-carrito');
    let resultado;
    
    if (carritoItems.length === 0) {
        errores.push('No hay productos en el Carrito');
    } else {
        carritoItems.forEach(item => {
            let stock = parseInt(item.getAttribute('data-stock'));
            let cantidad = parseInt(item.querySelector('.cantidad').textContent);
            
            // Obtener el nombre del producto, talla y color
            let nombreProducto = item.querySelector('.producto-nombre').textContent;
            let talla = item.querySelector('.producto-talla').textContent;
            let colorElement = item.querySelector('.producto-color');
            let color = colorElement.getAttribute('data-color');

            if (cantidad > stock) {
                errores.push(`La cantidad del producto "${nombreProducto}" (Talla: ${talla}, Color: ${color}) supera el stock disponible.`);
            }
        });
    }

    if (errores.length > 0) {
        mostrarPopupConErrores(errores);
        resultado = false;
    } else {
        resultado = true;
    }
    return resultado;
}


function mostrarPopupConErrores(errores) {
    eliminarMensajesPopup();
    errores.forEach(error => {
        anadirErrorPopup(error);
    });
    mostrarPopup();
}


let form = document.getElementById('formPedido');
form.addEventListener('submit', function(event) {
    event.preventDefault();
    
    if (validarCarrito()) {
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                let errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                let tokenInput = document.createElement('input');
                tokenInput.setAttribute('type', 'hidden');
                tokenInput.setAttribute('name', 'stripeToken');
                tokenInput.setAttribute('value', result.token.id);
                form.appendChild(tokenInput);
                
                form.submit();
            }
        });
    }
});