const inputCodigo = document.getElementById('codigo');
const iconoSugerirCodigo = document.getElementById('iconoSugerirCodigo');
const inputNombre = document.getElementById('nombre');
const formCrear = document.getElementById('formCrear');
const formEditar = document.getElementById('formEditar');

let codigoValido = false;
if (formEditar) {
    codigoValido = true;
}
let codigoInicial = inputCodigo.value;

function crearMensajeErrorCodigo() {
    const divInput = inputCodigo.parentElement; //Este es el div que contiene el input y el icono de sugerir código
    const divPadre = divInput.parentElement; //Este es el div que contiene el label y el div anterior
    if (!divPadre.querySelector('span')) {
        let spanMensaje = document.createElement('span');
        spanMensaje.classList.add('mensaje-error', 'text-red-500');
        spanMensaje.innerHTML = "El código debe empezar por 'PROD' y estar seguido de un número de 3 dígitos.";
        divPadre.appendChild(spanMensaje);
    }
}

function eliminarMensajeErrorCodigo() {
    const divInput = inputCodigo.parentElement;
    const divPadre = divInput.parentElement;
    const mensajeError = divPadre.querySelector('.mensaje-error');
    if (mensajeError) {
        divPadre.removeChild(mensajeError);
    }
}

async function obtenerNuevoCodigo() {
    eliminarMensajeErrorCodigo();
    let data = await recibirDatos('/fetch-codigoMasAltoTipoProducto', 'POST', 'Error al obtener el nuevo código');
    console.log(data);

    let codigoMasAlto = data.codigo;
    const nuevoNumero = 'PROD' + (Number(codigoMasAlto.slice(4)) + 1).toString().padStart(3, '0'); //Cogemos el código a partir de la parte númerica (a partir de la cuarta posición), le sumamos 1 y lo rellenamos con 0 a la izquierda.
    
    inputCodigo.value = nuevoNumero;
    codigoValido = true;
}

function validarCodigo() {
    inputCodigo.value = inputCodigo.value.trim().toUpperCase();
    const codigo = inputCodigo.value;
    if (codigo.length > 0) {
        const regex = /^PROD\d{3}$/;
        codigoValido = regex.test(codigo);
        if (codigoValido) {
            eliminarMensajeErrorCodigo();
        }
        else {
            crearMensajeErrorCodigo();
        }
    }
}

function validarNombre() {
    const nombre = inputNombre.value.trim();
    const esNumero = contieneSoloNumeros(nombre);
    if (esNumero) {
        inputNombre.value = inputNombre.value.slice(0, -1);
    }
    if (nombre.length === 1) {
        inputNombre.value = inputNombre.value.toUpperCase();
    }
}

async function validarEnvioFormulario(event, form) {
    event.preventDefault();
    eliminarMensajesPopup();
    if (codigoValido) {
        if (formCrear || formEditar && inputCodigo.value != codigoInicial) { //Si se está creando un nuevo producto o se está editando y el código ha cambiado
            const dataEnvio = {
                codigo : inputCodigo.value.trim(),
            };
            let data = await enviarDatos('/fetch-comprobarCodigoTipoProducto', dataEnvio, 'POST', 'Error al comprobar el código');
            console.log(data);
    
            if (data.existe) {
                anadirErrorPopup(data.mensaje);
                mostrarPopup();
            }
            else {
                form.submit();
            }
        }
        else {
            form.submit();
        }
    }
    else {
        anadirErrorPopup('El código no es correcto.');
        mostrarPopup();
    }
}

iconoSugerirCodigo.addEventListener('click', obtenerNuevoCodigo);

inputCodigo.addEventListener('input', validarCodigo);

inputNombre.addEventListener('input', validarNombre);

if (formCrear) {
    obtenerNuevoCodigo();
    formCrear.addEventListener('submit', function(event) {
        validarEnvioFormulario(event, formCrear);
    });
}
else {
    formEditar.addEventListener('submit', function(event) {
        validarEnvioFormulario(event, formEditar);
    });
}