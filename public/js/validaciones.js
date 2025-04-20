function contieneSoloNumeros(texto) {
    const regex = /^[0-9]+$/;
    return regex.test(texto);
}

function contieneSoloLetras(texto) {
    const regex = /^[a-zA-Z\s]+$/;
    return regex.test(texto);
}

function crearMensajeError(input, mensaje) {
    const divPadre = input.parentElement;
    if (!divPadre.querySelector('span')) {
        let spanMensaje = document.createElement('span');
        spanMensaje.classList.add('mensaje-error', 'text-red-500');
        spanMensaje.innerHTML = mensaje;
        divPadre.appendChild(spanMensaje);
    }
}

function eliminarMensajeError(input) {
    const divPadre = input.parentElement;
    const mensajeError = divPadre.querySelector('.mensaje-error');
    if (mensajeError) {
        divPadre.removeChild(mensajeError);
    }
}

const popupErrores = document.getElementById('popupErrores');
const btnCerrarPopup = document.getElementById('btnPopup');

function mostrarPopup() {
    popupErrores.classList.remove('hidden');
}

function eliminarMensajesPopup() {
    popupErrores.querySelector('ul').innerHTML = '';
}

function anadirErrorPopup(mensaje) {
    const listaErrores = popupErrores.querySelector('ul');
    let li = document.createElement('li');
    li.innerHTML = mensaje;
    listaErrores.appendChild(li);
}

if (popupErrores) {
    btnCerrarPopup.addEventListener('click', function() {
        popupErrores.classList.add('hidden');
    });
}