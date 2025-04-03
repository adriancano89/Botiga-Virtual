const inputCupon = document.getElementById('cupon');
const divCupon = document.getElementById('divCupon');
const divDetallesPedido = document.getElementById('detallesPedido');
const spanSubtotal = document.getElementById('subtotal');
const spanIva = document.getElementById('iva');
const spanTotal = document.getElementById('total');
const formPedido = document.getElementById('formPedido');
const popup = document.getElementById('popupError');
const mensajePopup = document.getElementById('mensajePopup');
const btnPopup = document.getElementById('btnPopup');

let subtotalInicial = spanSubtotal.textContent;
let ivaInicial = spanIva.textContent;
let totalInicial = spanTotal.textContent;
let precioEnvio = 4.99;

function crearMensajeError() {
    let spanMensaje = document.createElement('span');
    spanMensaje.textContent = 'Cupón no válido';
    spanMensaje.classList.add('text-red-500');

    return spanMensaje;
}

async function comprobarCupon(codigo) {
    const dataEnvio = {
        "codigo": codigo
    };
    let data = await enviarDatos('/fetch-comprobarCupon', dataEnvio, 'POST', 'Error al comprobar el cupon');
    console.log(data);
    
    return data.valido;
}

async function mostrarDescuento(codigo) {
    let divDescuento = document.createElement('div');
    divDescuento.className = 'flex flex-row justify-between';
    divDescuento.id = "descuento";
    let span = document.createElement('span');
    span.textContent = 'Descuento aplicado';

    const dataEnvio = {
        "codigo": codigo
    };
    let dataDescuento = await enviarDatos('/fetch-obtenerDescuento', dataEnvio, 'POST', 'Error al obtener el descuento');
    let spanDescuento = document.createElement('span');
    spanDescuento.textContent = dataDescuento.descuento + " %";
    divDescuento.appendChild(span);
    divDescuento.appendChild(spanDescuento)
    divDetallesPedido.appendChild(divDescuento);

    return dataDescuento.descuento;
}

function calcularPrecioConDescuento(descuento) {
    let subtotal = Number(subtotalInicial.slice(0, -1)); //Borramos el símbolo del euro
    console.log("subtotal: " + subtotal);
    subtotal = Number((subtotal - (subtotal * (descuento /100))).toFixed(2)); //Calculamos el nuevo subtotal con el descuento y redondeamos a 2 decimales
    console.log("Subtotal rebajado: " + subtotal);
    spanSubtotal.textContent = subtotal + " €";

    let nuevoIva = Number((subtotal * 0.21).toFixed(2)); //Calculamos el nuevo IVA, que es el 21% del subtotal
    spanIva.textContent = nuevoIva + " €";

    let nuevoTotal = subtotal + nuevoIva + precioEnvio;
    console.log("Nuevo total: " + nuevoTotal);
    spanTotal.innerHTML = "<s class='text-red-500'>" + totalInicial + "</s>" + " " + nuevoTotal + " €";
}

function inicializarDetallesPedido() {
    spanSubtotal.textContent = subtotalInicial;
    spanIva.textContent = ivaInicial;
    spanTotal.textContent = totalInicial;
    let mensajeAntiguo = divCupon.querySelector('span');
    if (mensajeAntiguo) {
        mensajeAntiguo.remove(); //Si existe el span del error, lo quitamos.
    }
    let divDescuento = document.getElementById('descuento');
    if (divDescuento) {
        divDescuento.remove();
    }
    inputCupon.classList.remove('borde-rojo', 'borde-verde');
}

inputCupon.addEventListener('change', async function() {
    inicializarDetallesPedido();

    const codigo = inputCupon.value.trim();

    if (codigo != '') {
        const cuponValido = await comprobarCupon(codigo);
        let bordeInput = 'borde-rojo';
        if (cuponValido) {
            bordeInput = 'borde-verde';
            let descuento = await mostrarDescuento(codigo);
            calcularPrecioConDescuento(descuento);
        }
        else {
            let mensajeError = crearMensajeError();
            divCupon.appendChild(mensajeError);
        }
        inputCupon.classList.add(bordeInput);
    }
});

formPedido.addEventListener('submit', async function(event) {
    event.preventDefault();
    
    const codigo = inputCupon.value.trim();

    if (codigo != '') {
        const cuponValido = await comprobarCupon(codigo);
        console.log("Valido: " + cuponValido);
        if (cuponValido) {
            formPedido.submit();
        }
        else {
            mensajePopup.textContent = 'Cupón no válido.';
            popup.classList.remove('hidden');
            btnPopup.addEventListener('click', function() {
                popup.classList.add('hidden');
            });
        }
    }
});