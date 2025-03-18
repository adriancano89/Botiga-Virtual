const tablaCarritoLS = document.getElementById('tablaCarritoLS');

function crearCeldaTabla(contenido) {
    let celda = document.createElement('td');
    celda.textContent = contenido;
    celda.classList.add('border-2', 'border-[#131620]', 'text-center', 'p-2');
    return celda;
}

function eliminarProductoLS(idProducto) {
    localStorage.removeItem('carrito-' + idProducto);
}

function generarFilaTabla(idProducto, nombreProducto, talla, color, cantidad, precio) {
    let tr = document.createElement('tr');
    tr.id = idProducto;

    let tdNombre = crearCeldaTabla(nombreProducto);

    let tdTalla = crearCeldaTabla(talla);

    let tdColor = crearCeldaTabla(color);

    let tdCantidad = crearCeldaTabla(cantidad);

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

function recogerDatosLS() {
    for (let i = 0; i < localStorage.length; i++) {
        let key = localStorage.key(i);
        let arraySplit = key.split('-');
        let primeraPosicion = arraySplit[0];

        if (primeraPosicion == 'carrito') { // Comprobar que la clave empieza por 'carrito'
            let cadenaDatos = localStorage.getItem(key);
            let datosProducto = JSON.parse(cadenaDatos); // Convertimos la cadena a objeto
            console.log(datosProducto);

            datosProducto = datosProducto.producto[0]; // Accedemos a la posición 0 que es donde están los datos del producto
            console.log(datosProducto);

            let nombreProducto = datosProducto.tipo_producto.nombre;
            let talla = datosProducto.talla.nombre;
            let color = datosProducto.color.nombre;
            let cantidad = datosProducto.cantidad;
            let idProducto = datosProducto.id;
            let precio = datosProducto.precio;

            generarFilaTabla(idProducto, nombreProducto, talla, color, cantidad, precio);
        }
    }
}



recogerDatosLS();