const tablaCarritoLS = document.getElementById('tablaCarritoLS');
let validado;

function sumarProductoAlTotal(precioTotalProducto) {
    let subtotalActual = Number(subtotal.textContent.slice(0, -1)) + precioTotalProducto;
    actualizarPreciosDOM(subtotalActual);
}

function restarProductoDelTotal(precioTotalProducto) {
    let subtotalActual = Number(subtotal.textContent.slice(0, -1)) - precioTotalProducto;
    actualizarPreciosDOM(subtotalActual);
}

// recogerDatosLS()
for (let i = 0; i < localStorage.length; i++) {
    let key = localStorage.key(i);
    let arraySplit = key.split('-');
    let primeraPosicion = arraySplit[0];

    if (primeraPosicion == 'carrito') { // Comprobar que la clave empieza por 'carrito'
        let cadenaDatos = localStorage.getItem(key);
        let datosProducto = JSON.parse(cadenaDatos); // Convertimos la cadena a objeto

        datosProducto = datosProducto.producto[0]; // Accedemos a la posición 0 que es donde están los datos del producto

        let idTipoProducto = datosProducto.tipo_producto.id;
        let foto = datosProducto.tipo_producto.foto;
        let nombreProducto = datosProducto.tipo_producto.nombre;
        let categoria = datosProducto.tipo_producto.categoria.nombre;
        let talla = datosProducto.talla.nombre;
        let color = datosProducto.color.hexadecimal;
        let cantidad = datosProducto.cantidad;
        let idProducto = datosProducto.id;
        let precioUnidad = datosProducto.tipo_producto.precio;
        let precioTotal = datosProducto.precio;
        sumarProductoAlTotal(precioTotal);
        crearContenedorProducto(idProducto, idTipoProducto, foto, nombreProducto, categoria, talla, color, cantidad, precioUnidad, precioTotal);
    }
}

// Crear una función para generar el select
async function crearSelect(idProducto,cantidadSeleccionada) {
    let cantidadMaxima = await obtenerCantidadMaxima(idProducto);
    let select = document.createElement('select');
    select.className = 'cantidades';
    select.id = idProducto;

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

function eliminarProducto(idProducto, precioUnidad) {
    localStorage.removeItem('carrito-' + idProducto);
    let cantidadActual = document.getElementById(idProducto).value; //Accedemos al valor del select de la cantidad
    restarProductoDelTotal(precioUnidad * cantidadActual);
}

async function crearContenedorProducto(idProducto, idTipoProducto, foto, nombreProducto, categoria, talla, color, cantidad, precioUnidad, precioTotal) {
    let divPadre = document.createElement('div');
    divPadre.classList.add('shadow-xl', 'rounded-[15px]', 'p-4', 'bg-white', 'text-center', 'flex', 'space-x-4', 'mt-5');

    let divImagen = document.createElement('div');
    divImagen.classList.add('w-[25%]', 'p-1', 'flex', 'justify-center', 'items-center');
    let imagen = document.createElement('img');
    imagen.src = 'storage/' + foto;
    imagen.alt = `Imagen de ${nombreProducto}`;
    divImagen.appendChild(imagen);

    // Contenido del contenedor principal
    let divContenido = document.createElement('div');
    divContenido.classList.add('w-[75%]', 'p-1');

    // Nombre y botón eliminar
    let divHeader = document.createElement('div');
    divHeader.classList.add('flex', 'justify-between', 'items-center');

    let divNombre = document.createElement('div');
    divNombre.classList.add('w-[80%]', 'p-1', 'text-left', 'text-2xl');
    divNombre.textContent = nombreProducto;

    let divEliminar = document.createElement('div');
    divEliminar.classList.add('w-[20%]', 'p-1', 'flex', 'flex-row', 'justify-end');
    let btnEliminar = document.createElement('img');
    btnEliminar.src = 'icons/general/borrar.png';
    btnEliminar.alt = 'Eliminar Producto';
    btnEliminar.classList.add('w-[25px]', 'hover:cursor-pointer');
    btnEliminar.title = 'Quitar del carrito';
    btnEliminar.addEventListener('click', () => {
        eliminarProducto(idProducto, precioUnidad);
        divPadre.remove();
        if (tablaCarritoLS.children.length === 0) {
            tablaCarritoLS.innerHTML = '<span>No hay productos en el carrito.</span>';
        }
    });
    divEliminar.appendChild(btnEliminar);

    divHeader.append(divNombre, divEliminar);

    //Categoría y opción de ver el producto
    let divMedio = document.createElement('div');
    divMedio.classList.add('flex', 'justify-between', 'items-center');

    let divCategoria = document.createElement('div');
    divCategoria.classList.add('w-[50%]', 'p-1', 'text-left', 'text-lm', 'text-[#4B5563]');
    divCategoria.textContent = categoria;

    let divVerProducto = document.createElement('div');
    divVerProducto.classList.add('w-[50%]', 'p-1', 'text-right', 'color-letra-secundaria', 'flex', 'justify-end');

    let link = document.createElement('a');
    link.href = '/productos/' + idTipoProducto;
    link.target = '_blank';

    let btnVer = document.createElement('button');
    btnVer.classList.add('flex', 'items-center');

    let iconoOjo = document.createElement('img');
    iconoOjo.src = 'icons/general/ojo.png';
    iconoOjo.alt = 'Ver Producto';
    iconoOjo.classList.add('w-6', 'h-6', 'mr-2');

    let textoBtn = document.createTextNode('Ver Producto');
    btnVer.append(iconoOjo, textoBtn);
    link.appendChild(btnVer);
    divVerProducto.appendChild(link);

    divMedio.append(divCategoria, divVerProducto);

    // Color, talla, cantidad, precio
    let divEtiquetas = document.createElement('div');
    divEtiquetas.classList.add('flex', 'justify-between', 'mt-5');
    const etiquetas = ['Color', 'Talla', 'Cantidad', 'Precio unidad', 'Precio total'];
    etiquetas.forEach(texto => {
        let div = document.createElement('div');
        div.classList.add('w-[20%]', 'p-1');
        div.textContent = texto;
        divEtiquetas.appendChild(div);
    });

    let divValores = document.createElement('div');
    divValores.classList.add('flex', 'justify-between');
    divValores.id = 'datosProducto-' + idProducto; 

    // Color visual
    let divColor = document.createElement('div');
    divColor.classList.add('w-[20%]', 'p-1');
    let circuloColor = document.createElement('div');
    circuloColor.style.backgroundColor = color;
    circuloColor.style.height = '20px';
    circuloColor.classList.add('rounded-[100px]');
    divColor.appendChild(circuloColor);

    // Talla
    let divTalla = document.createElement('div');
    divTalla.classList.add('w-[20%]', 'p-1');
    divTalla.textContent = talla;

    // Cantidad (select)
    let divCantidad = document.createElement('div');
    divCantidad.classList.add('w-[20%]', 'p-1');
    let selectCantidad = await crearSelect(idProducto, cantidad);
    divCantidad.appendChild(selectCantidad);

    // Precio unidad
    let divPrecioUnidad = document.createElement('div');
    divPrecioUnidad.classList.add('w-[20%]', 'p-1', 'precio-unidad');
    divPrecioUnidad.textContent = precioUnidad + ' €';

    // Precio total
    let divPrecioTotal = document.createElement('div');
    divPrecioTotal.classList.add('w-[20%]', 'p-1', 'font-semibold', 'precio-total');
    divPrecioTotal.textContent = precioTotal.toFixed(2) + ' €';

    divValores.append(divColor, divTalla, divCantidad, divPrecioUnidad, divPrecioTotal);

    divContenido.append(divHeader, divMedio, divEtiquetas, divValores);

    divPadre.append(divImagen, divContenido);
    tablaCarritoLS.appendChild(divPadre);
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
        let cantidadInicial = element.value;
        element.addEventListener('input', () => {
            actualizarCantidadCarrito(element.id, element.value);
            actualizarPrecioTotal(cantidadInicial, element.value, element.id);
            cantidadInicial = element.value;
        });
    });
}

async function actualizarCantidadCarrito(idCarrito, nuevaCantidad) {
    if (validado) {
        const dataEnvio = {
            cantidad: nuevaCantidad
        };
        let data = await enviarDatos(`/carrito/${idCarrito}`, dataEnvio, 'POST', 'Error al cambiar la cantidad del carrito');
        console.log(data);
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
    else {
        if (tablaCarritoLS.children.length === 0) {
            tablaCarritoLS.innerHTML = '<span>No hay productos en el carrito.</span>';
        }
    }
    selecionarSelect();
}

main();