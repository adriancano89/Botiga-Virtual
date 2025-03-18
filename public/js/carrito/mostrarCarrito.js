const tablaCarritoLS = document.getElementById('tablaCarritoLS');
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function crearCeldaTabla(contenido) {
    let celda = document.createElement('td');
    celda.textContent = contenido;
    celda.classList.add('border-2', 'border-[#131620]', 'text-center', 'p-2');
    return celda;
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

async function insertarCarritoenBD() {
    for (let i = 0; i < localStorage.length; i++) {
        let key = localStorage.key(i);
        let arraySplit = key.split('-');
        let primeraPosicion = arraySplit[0];

        if (primeraPosicion == 'carrito') { // Comprobar que la clave empieza por 'carrito'
            let cadenaDatos = localStorage.getItem(key);
            let datosProducto = JSON.parse(cadenaDatos); // Convertimos la cadena a objeto

            datosProducto = datosProducto.producto[0]; // Accedemos a la posición 0 que es donde están los datos del producto

            let tipoProductoid = datosProducto.tipo_producto.id;
            let tallaid = datosProducto.talla.id;
            let colorid = datosProducto.color.id;
            let cantidad = datosProducto.cantidad;

            etch('/fetch-InsertarCarritoenBD', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    "tipos_producto_id": tipoProductoid,
                    "color_id": colorid,
                    "talla_id": tallaid,
                    "cantidad": cantidad
                })
            })
            .then(response => response.json())
            .then(data => {
                localStorage.removeItem('carrito-' + datosProducto.id);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    }
}

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


async function main() {
    let validado = await consultarUsuarioValidado();

    if (validado) {
        await insertarCarritoenBD();
    } else {
        recogerDatosLS();
    }
}

main();