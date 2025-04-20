const inputNombre = document.getElementById('nombre');

function validarNombre() {
    inputNombre.value = inputNombre.value.toUpperCase();
    const nombre = inputNombre.value.trim();
    const esValido = contieneSoloLetras(nombre);

    if (!esValido) {
        inputNombre.value = inputNombre.value.slice(0, -1);
    }
}

inputNombre.addEventListener('input', validarNombre);