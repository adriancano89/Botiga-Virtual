const tablaCarritoLS = document.getElementById('tablaCarritoLS');
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let validado;

// recogerDatosLS()
for (let i = 0; i < localStorage.length; i++) {
    let key = localStorage.key(i);
    let arraySplit = key.split('-');
    let primeraPosicion = arraySplit[0];

    if (primeraPosicion == 'carrito') { // Comprobar que la clave empieza por 'carrito'
        let cadenaDatos = localStorage.getItem(key);
        let datosProducto = JSON.parse(cadenaDatos); // Convertimos la cadena a objeto

        datosProducto = datosProducto.producto[0]; // Accedemos a la posición 0 que es donde están los datos del producto

        let nombreProducto = datosProducto.tipo_producto.nombre;
        let talla = datosProducto.talla.nombre;
        let color = datosProducto.color.nombre;
        let cantidad = datosProducto.cantidad;
        let idProducto = datosProducto.id;
        let precio = datosProducto.precio;

        generarFilaTabla(idProducto, nombreProducto, talla, color, cantidad, precio);
    }
}

function crearCeldaTabla(contenido) {
    let celda = document.createElement('td');
    celda.textContent = contenido;
    celda.classList.add('border-2', 'border-[#131620]', 'text-center', 'p-2');
    return celda;
}

// Crear una función para generar el select
async function crearSelect(idProducto,cantidadSeleccionada) {
    let cantidadMaxima = await obtenerCantidadMaxima(idProducto);
    let select = document.createElement('select');
    select.className = 'cantidades';
    select.setAttribute("idProducto", idProducto);

    for (let i = 1; i <= cantidadMaxima; i++) {
        let option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        if (i == cantidadSeleccionada) {
            option.selected = true; // Poner la opción seleccionada
        }
        select.appendChild(option);
    }

    return select;
}

function eliminarProductoLS(idProducto) {
    localStorage.removeItem('carrito-' + idProducto);
}

async function generarFilaTabla(idProducto, nombreProducto, talla, color, cantidad, precio) {
    let tr = document.createElement('tr');
    tr.id = idProducto;

    let tdNombre = crearCeldaTabla(nombreProducto);

    let tdTalla = crearCeldaTabla(talla);

    let tdColor = crearCeldaTabla(color);

    let tdCantidad = document.createElement('td');
    let select = await crearSelect(idProducto, cantidad); // Espera a que crearSelect devuelva el elemento select
    tdCantidad.appendChild(select); // Ahora puedes agregar el select al td
    tdCantidad.classList.add('border-2', 'border-[#131620]', 'flex', 'flex-row', 'justify-center', 'p-2');

    let tdPrecio = crearCeldaTabla(precio + ' €');

    let tdEliminar = document.createElement('td');
    tdEliminar.classList.add('border-2', 'border-[#131620]', 'flex', 'flex-row', 'justify-center', 'p-2');
    let iconoEliminar = document.createElement('img');
    iconoEliminar.src = 'icons/general/papelera.png';
    iconoEliminar.classList.add('w-6', 'hover:cursor-pointer');

    iconoEliminar.addEventListener('click', function() {
        let padre = iconoEliminar.parentElement;
        let trPadre = padre.parentElement; //Accedemos al tr del td que contiene la imagen
        tablaCarritoLS.removeChild(trPadre);
        eliminarProductoLS(trPadre.id);
    });

    tdEliminar.appendChild(iconoEliminar);


    tr.append(tdNombre, tdTalla, tdColor, tdCantidad, tdPrecio, tdEliminar);
    tablaCarritoLS.appendChild(tr);
}

async function insertarCarritoenBD() {
    for (let i = 0; i < localStorage.length; i++) {
        let key = localStorage.key(i);
        let arraySplit = key.split('-');
        let primeraPosicion = arraySplit[0];

        if (primeraPosicion == 'carrito') { // Comprobar que la clave empieza por 'carrito'
            let cadenaDatos = localStorage.getItem(key);
            let datosProducto = JSON.parse(cadenaDatos); // Convertimos la cadena a objeto

            datosProducto = datosProducto.producto[0]; // Accedemos a la posición 0 que es donde están los datos del producto

            let tipoidCarrito = datosProducto.tipo_producto.id;
            let tallaid = datosProducto.talla.id;
            let colorid = datosProducto.color.id;
            let cantidad = datosProducto.cantidad;

            const dataEnvio = {
                "tipos_producto_id": tipoidCarrito,
                "color_id": colorid,
                "talla_id": tallaid,
                "cantidad": cantidad
            };

            let data = await enviarDatos('/fetch-InsertarCarritoenBD', dataEnvio, 'POST', 'Error al insertar el carrito en la base de datos');
            if (data) {
                localStorage.removeItem('carrito-' + datosProducto.id);
            }
        }
    }
}

function selecionarSelect() {
    const selectElements = document.querySelectorAll('.cantidades');
    selectElements.forEach(element => {
        element.addEventListener('input', () => {
            if (element.id) {
                actualizarCantidadCarrito(element.id, element.value);
            } else {
                let idProducto = element.getAttribute('idProducto');
                actualizarCantidadCarrito(idProducto, element.value);
            }

        })
    });
}

async function actualizarCantidadCarrito(idCarrito, nuevaCantidad) {
    if (validado) {
        const dataEnvio = {
            cantidad: nuevaCantidad
        };
        let data = await enviarDatos(`/carrito/${idCarrito}`, dataEnvio, 'POST', 'Error al cambiar la cantidad del carrito');
    } else {
        // Recuperar el objeto del Local Storage usando el nombre correcto
        let productoGuardado = localStorage.getItem('carrito-' + idCarrito);
        // Verifica si el producto existe en el Local Storage
        if (productoGuardado) {
            // Convertir el string JSON a un objeto
            let productos = JSON.parse(productoGuardado);

            productos.producto[0].cantidad = nuevaCantidad; // Ayado la nueva cantidad

            // Guardar el objeto actualizado de nuevo en el Local Storage
            localStorage.setItem('carrito-' + idCarrito, JSON.stringify(productos));
        } else {
            console.log("No se encontró el producto en el Local Storage.");
        }
    }
}

async function obtenerCantidadMaxima(idProducto) {
    let retornarStock = null;
    const dataEnvio = {
        id: idProducto
    };
    let data = await enviarDatos('/fetch-ObtenerCantidadMaxima', dataEnvio, 'POST', 'Error al obtener la cantidad máxima del producto');
    if (data && data.stock != undefined) {
        retornarStock = data.stock;
    } else {
        console.log('Producto no encontrado o no tiene stock');
    }
    return retornarStock;
}

async function main() {
    validado = await consultarUsuarioValidado();

    if (validado) {
        await insertarCarritoenBD();
    }
    selecionarSelect();
}

main();