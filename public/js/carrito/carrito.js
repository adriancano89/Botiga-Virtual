const formularioAnadirCarrito = document.getElementById('formularioAnadirCarrito');
const tiposProducto = document.getElementById('tipos_producto_id');
const color = document.getElementById('color_id');
const talla = document.getElementById('talla_id');
const cantidad = document.getElementById('cantidad');

async function usuarioValidado() {
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
        body : JSON.stringify()
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
}

function guardarCarritoLS(clave, jsonProducto) {
    let jsonProductoString = JSON.stringify(jsonProducto);
    localStorage.setItem(clave, jsonProductoString);
}

formularioAnadirCarrito.addEventListener('submit', function(event) {
    if (usuario.value == 0) {
        event.preventDefault();
        const jsonProducto = {
            "tiposProductoId" : tiposProducto.value,
            "color_id" : color.value,
            "talla_id" : talla.value,
            "cantidad" : cantidad.value
        };
        guardarCarritoLS('carrito-' + tiposProducto.value + '_' + talla.value + '_' + color.value, jsonProducto);
    }
});