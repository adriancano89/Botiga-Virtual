const inputCodigo = document.getElementById('codigo');
const inputNombre = document.getElementById('nombre');
const formCrear = document.getElementById('formCrear');
const formEditar = document.getElementById('formEditar');

let codigoValido = false;
let nombreValido = false;
if (formEditar) {
    codigoValido = true;
    nombreValido = true;
}
let codigoInicial = inputCodigo.value;
let nombreInicial = inputNombre.value;

async function validarCodigo() {
    inputCodigo.value = inputCodigo.value.trim().toUpperCase();
    const codigo = inputCodigo.value;
    if (codigo.length === 1) {
        const regex = /^[HMN]$/;
        const letraValida = regex.test(codigo);
        if (letraValida) {
            eliminarMensajeError(inputCodigo);
            const dataEnvio = {
                letra : codigo
            };
            let data = await enviarDatos('/fetch-codigoMasAltoCategoria', dataEnvio, 'POST', 'Error al obtener el nuevo código');
            console.log(data);

            let codigoMasAlto = data.codigo;
            const codigoSumado = Number(codigoMasAlto.slice(1)) + 1; //Obtenemos la parte numérica con slice(1) para obtener el string a partir del segundo caracter
            const nuevoCodigo = codigo + codigoSumado.toString(); //Codigo es la letra que hay en el input
            console.log("Nuevo código: " + nuevoCodigo);
            inputCodigo.value = nuevoCodigo;
            codigoValido = true;
        }
        else {
            inputCodigo.value = '';
            crearMensajeError(inputCodigo, "El código debe empezar por la inicial del género ('H', 'M', 'N')");
        }
    }
    else if (codigo.length > 1) {
        const regex = /^[HMN][0-9]+$/;
        codigoValido = regex.test(codigo);

        if (codigoValido) {
            eliminarMensajeError(inputCodigo);
        }
        else {
            inputCodigo.value = codigo.slice(0, -1);
            crearMensajeError(inputCodigo, "El código debe contener la inicial del género ('H', 'M', 'N') e ir seguida de números");
        }
    }
}

function validarNombre() {
    const nombre = inputNombre.value.trim();

    const regex = /^[^\|]+ \| [^\|]+ \| (Hombre|Mujer|Niño)$/; //Debe empezar por texto separado por un espacio y una barra, seguido de texto separado por un espacio y una barra, y finalmente por el género

    nombreValido = regex.test(nombre);

    if (nombreValido) {
        eliminarMensajeError(inputNombre);
    }
    else {
        crearMensajeError(inputNombre, 'El nombre de la categoria debe ser del formato: Texto | Texto | Género');
    }
}

async function comprobarExisteCodigoYNombre(form) {
    let codigoExiste = false;
    let dataEnvio = {
        codigo : inputCodigo.value.trim(),
    };
    let data = await enviarDatos('/fetch-comprobarCodigoCategoria', dataEnvio, 'POST', 'Error al comprobar si existe el código.');
    console.log(data);
    if (data.existe) {
        anadirErrorPopup(data.mensaje);
        codigoExiste = true;
    }

    let nombreExiste = false;
    dataEnvio = {
        nombre : inputNombre.value.trim(),
    };
    data = await enviarDatos('/fetch-comprobarNombreCategoria', dataEnvio, 'POST', 'Error al comprobar si existe el nombre.');
    if (data.existe) {
        anadirErrorPopup(data.mensaje);
        nombreExiste = true;
    }

    if (codigoExiste || nombreExiste) {
        mostrarPopup();
    }
    else {
        form.submit();
    }
}

async function comprobarExisteCodigo(form) {
    const dataEnvio = {
        codigo : inputCodigo.value.trim(),
    };
    let data = await enviarDatos('/fetch-comprobarCodigoCategoria', dataEnvio, 'POST', 'Error al comprobar si existe el código.');
    console.log(data);
    if (data.existe) {
        anadirErrorPopup(data.mensaje);
        mostrarPopup();
    }
    else {
        form.submit();
    }
}

async function comprobarExisteNombre(form) {
    const dataEnvio = {
        nombre : inputNombre.value.trim(),
    };
    let data = await enviarDatos('/fetch-comprobarNombreCategoria', dataEnvio, 'POST', 'Error al comprobar si existe el nombre.');
    console.log(data);
    if (data.existe) {
        anadirErrorPopup(data.mensaje);
        mostrarPopup();
    }
    else {
        form.submit();
    }
}

async function validarEnvioFormulario(event, form) {
    event.preventDefault();
    eliminarMensajesPopup();

    if (codigoValido && nombreValido) {
        if (formCrear) {
            comprobarExisteCodigoYNombre(form);
        }
        else if (formEditar && inputCodigo.value != codigoInicial) { // Si el código es distinto al inicial, comprobamos si existe
            comprobarExisteCodigo(form);
        }
        else if (formEditar && inputNombre.value != nombreInicial) { // Si el nombre es distinto al inicial, comprobamos si existe
            comprobarExisteNombre(form);
        }
        else {
            form.submit();
        }
    }
    else {
        if (!codigoValido) {
            anadirErrorPopup('El código no es correcto.');
        }
        if (!nombreValido) {
            anadirErrorPopup('El nombre no es correcto.');
        }
        mostrarPopup();
    }
}

inputCodigo.addEventListener('input', validarCodigo);

inputNombre.addEventListener('input', validarNombre);

if (formCrear) {
    formCrear.addEventListener('submit', function(event) {
        validarEnvioFormulario(event, formCrear);
    });
}
else {
    formEditar.addEventListener('submit', function(event) {
        validarEnvioFormulario(event, formEditar);
    });
}