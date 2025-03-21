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
        const jsonProducto = await obtenerDatosProducto(tipoProducto.value, talla.value, color.value);
        const idProducto = jsonProducto.producto[0].id; // Obtenemos el id del producto
        jsonProducto.producto[0].cantidad = cantidad.value;
        event.preventDefault();
        jsonProducto.producto[0].precio = jsonProducto.producto[0].tipo_producto.precio;

        if (localStorage.getItem('carrito-' + idProducto) != null) {
            let cantidadActual = parseInt(jsonProducto.producto[0].cantidad);
            let cantidadNueva = parseInt(cantidad.value);

            if (jsonProducto.producto[0].stock >= (cantidadActual + cantidadNueva)) {
                jsonProducto.producto[0].cantidad = cantidadActual + cantidadNueva;
            } else {
                jsonProducto.producto[0].cantidad = jsonProducto.producto[0].stock;
            }
        }
        guardarCarritoLS('carrito-' + idProducto, jsonProducto);
    }
});

async function usuarioValidado() {
    validado = await consultarUsuarioValidado();
}

usuarioValidado();