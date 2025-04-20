const inputNombre = document.getElementById('nombre');
const inputApellidos = document.getElementById('apellidos');
const inputEmail = document.getElementById('email');
const inputTelefono = document.getElementById('telefono');
const inputDireccion = document.getElementById('direccion');
const formulario = document.getElementById('formulario');

let telefonoValido = false;
let emailValido = false;

function validarNombre() {
    const nombre = inputNombre.value.trim();
    const esNumero = contieneSoloNumeros(nombre);

    if (esNumero) {
        inputNombre.value = inputNombre.value.slice(0, -1);
    }
}

function validarApellidos() {
    const apellidos = inputApellidos.value.trim();
    const regex = /^[A-Za-zÁÉÍÓÚÑáéíóúñ]+(?:\s[A-Za-zÁÉÍÓÚÑáéíóúñ]+)?$/;
    const esValido = regex.test(apellidos);
    if (!esValido) {
        inputApellidos.value = inputApellidos.value.slice(0, -1);
    }
}

function validarTelefono() {
    const telefono = inputTelefono.value.trim();
    const regex = /^([67])\d{8}$/;
    telefonoValido = regex.test(telefono);
    if (!telefonoValido) {
        crearMensajeError(inputTelefono, 'El número de teléfono debe comenzar con 6 o 7 y tener 9 dígitos en total');
    }
    else {
        eliminarMensajeError(inputTelefono);
    }
}

function validarEmail() {
    const email = inputEmail.value.trim();
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // El email debe tener texto, una @, otro texto, un punto y texto.
    emailValido = regex.test(email);
    if (!emailValido) {
        crearMensajeError(inputEmail, 'Introduce un correo electrónico válido');
    }
    else {
        eliminarMensajeError(inputEmail);
    }
}

function validarDireccion() {
    const direccion = inputDireccion.value.trim();

    const esNumero = contieneSoloNumeros(direccion);
    if (esNumero) {
        inputDireccion.value = inputDireccion.value.slice(0, -1);
    }
}

inputNombre.addEventListener('input', validarNombre);

inputApellidos.addEventListener('input', validarApellidos);

inputTelefono.addEventListener('input', validarTelefono);

inputEmail.addEventListener('input', validarEmail);

inputDireccion.addEventListener('input', validarDireccion);

formulario.addEventListener('submit', function(event) {
    event.preventDefault();
    
    if (emailValido && telefonoValido) {
        formulario.submit();
    }
    else {
        eliminarMensajesPopup();
        if (!emailValido) {
            anadirErrorPopup('El email introducido no es válido.');
        }
        if (!telefonoValido) {
            anadirErrorPopup('El teléfono introducido debe empezar por 6 o 7 y tener 9 dígitos en total.');
        }
        mostrarPopup();
    }
});