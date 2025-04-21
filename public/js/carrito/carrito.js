const formularioAnadirCarrito = document.getElementById('formularioAnadirCarrito');
const tipoProducto = document.getElementById('tipos_producto_id');
const color = document.getElementById('color_id');
const talla = document.getElementById('talla_id');
const cantidad = document.getElementById('cantidad');
let validado = false;

function guardarCarritoLS(clave, jsonProducto) {
    let jsonProductoString = JSON.stringify(jsonProducto); // Convertimos el objeto a string
    localStorage.setItem(clave, jsonProductoString);
}

formularioAnadirCarrito.addEventListener('submit', async function(event) {
    event.preventDefault();
    if (!validado) {
        const datosEnvio = {
            "idTipoProducto": tipoProducto.value,
            "idTalla" : talla.value,
            "idColor" : color.value
        };
        const jsonProducto = await enviarDatos('/fetch-DatosProducto', datosEnvio, 'POST', 'Error al obtener los datos del producto');
        const idProducto = jsonProducto.producto[0].id; // Obtenemos el id del producto
        jsonProducto.producto[0].cantidad = cantidad.value;
        jsonProducto.producto[0].precio = jsonProducto.producto[0].tipo_producto.precio * cantidad.value;

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
    else {
        formularioAnadirCarrito.submit();
    }
});

async function usuarioValidado() {
    validado = await consultarUsuarioValidado();
}

usuarioValidado();