const formularioAnadirCarrito = document.getElementById('formularioAnadirCarrito');
const tipoProducto = document.getElementById('tipos_producto_id');
const color = document.getElementById('color_id');
const talla = document.getElementById('talla_id');
const cantidad = document.getElementById('cantidad');
let validado = false;

async function consultarUsuarioValidado() {
    let data;
    try {
        const promesa = await fetch('/fetch-UsuarioValidado', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        }
        });

        if (!promesa.ok) {
            throw new Error('Error al comprobar si el usuario está validado');
        }

        data = await promesa.json();
        console.log(data);
    }
    catch (error) {
        console.error(error);
    }
    return data.validado;
}

async function obtenerDatosProducto(idTipoProducto, idTalla, idColor) {
    let data;
    let datosEnvio = {
        "idTipoProducto": idTipoProducto,
        "idTalla" : idTalla,
        "idColor" : idColor
    }
    try {
        const promesa = await fetch('/fetch-DatosProducto', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body : JSON.stringify(datosEnvio)
        });

        if (!promesa.ok) {
            throw new Error('Error al obtener los datos del producto');
        }

        data = await promesa.json();
        console.log(data);
    }
    catch (error) {
        console.error(error);
    }

    return data;
}

function guardarCarritoLS(clave, jsonProducto) {
    let jsonProductoString = JSON.stringify(jsonProducto); // Convertimos el objeto a string
    localStorage.setItem(clave, jsonProductoString);
}

formularioAnadirCarrito.addEventListener('submit', async function(event) {
    if (!validado) {
        event.preventDefault();
        const jsonProducto = await obtenerDatosProducto(tipoProducto.value, talla.value, color.value);
        const idProducto = jsonProducto.producto[0].id; // Obtenemos el id del producto
        jsonProducto.producto[0].cantidad = cantidad.value;
        jsonProducto.producto[0].precio = jsonProducto.producto[0].tipo_producto.precio * cantidad.value;
        guardarCarritoLS('carrito-' + idProducto, jsonProducto);
    }
});

async function usuarioValidado() {
    validado = await consultarUsuarioValidado();
}

usuarioValidado();