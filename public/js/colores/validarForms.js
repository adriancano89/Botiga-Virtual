const inputNombre = document.getElementById('nombre');

function validarNombre() {
    const nombre = inputNombre.value.trim();
    const esValido = contieneSoloLetras(nombre);

    if (!esValido) {
        inputNombre.value = inputNombre.value.slice(0, -1);
    }
    if (nombre.length === 1) {
        inputNombre.value = inputNombre.value.toUpperCase();
    }
}

inputNombre.addEventListener('input', validarNombre);