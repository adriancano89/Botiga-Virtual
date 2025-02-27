const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const divProductos = document.getElementById('productos');
const paginacion = document.getElementById('paginacion');
let numPagina = 1;

async function obtenerProductos(pagina) {
    let data;
    try {
        const promesa = await fetch(pagina, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        }
        });

        if (!promesa.ok) {
            throw new Error('Error al obtener los productos');
        }

        data = await promesa.json();
    }
    catch (error) {
            console.error(error);
    }
    return data;
}

function mostrarProductos(datos, div) {
    console.log(datos);
    let dataProductos = datos.data;

    div.innerHTML = '';

    for (let clave in dataProductos) {
        console.log(dataProductos[clave]);
        let datosProducto = dataProductos[clave];
        let id = datosProducto.id;
        let codigo = datosProducto.codigo;
        let nombre = datosProducto.nombre;
        let precio = datosProducto.precio;
        div.innerHTML += `
        <div class="shadow-xl rounded-[15px] p-4 hover:bg-slate-300 hover:cursor-pointer">
            <div class="flex flex-row">
                <img src="icons/general/con-capucha.png" alt="imagen producto" class="w-26 h-26">
                <a href='tiposProductos/${id}/edit'><img src="icons/general/editar.png" alt="editar producto" class="w-8 h-8 mt-2" title="Editar producto"></a>
                <img src="icons/general/papelera.png" alt="eliminar producto" class="w-8 h-8 mt-2" title="Eliminar producto">
            </div>
            <h2 class="font-bold text-lg">${nombre}</h2>
            <span class="text-gray-500">${codigo}</span>
            <div class="flex flex-row justify-between">
                <span class="text-[#0983AC] font-bold">${precio} €</span>
                <div class="flex flex-row">
                    <img src="icons/general/mas.png" alt="añadir stock" class="w-[25px] hover:cursor-pointer" title="Añadir stock">
                    <span></span>
                </div>
            </div>
        </div>`;
    }
}

function mostrarPaginacion(datos, div) {
    let links = datos.links;
    for (let clave in links) {
        if (clave != 0 && clave != links.length - 1) {
            let link = links[clave];
            let enlacePagina = document.createElement('a');
            enlacePagina.href = link.url;
            enlacePagina.innerHTML = link.label;
            enlacePagina.classList.add('enlaces', 'p-2');
            enlacePagina.addEventListener('click', function() {
                numPagina = Number(enlacePagina.textContent);
                enlacePagina.classList.remove('hover:bg-gray-200');
                enlacePagina.classList.add('bg-[#0983AC]', 'text-white');
            });
            div.insertBefore(enlacePagina, div.lastElementChild); //Lo añadimos antes del ultimo elemento, que es el enlace de Siguiente
        }
    }
}

function actualizarPaginacion(datos) {

    const paginaAnterior = document.getElementById('paginaAnterior');
    const paginaSiguiente = document.getElementById('paginaSiguiente');

    if (datos.prev_page_url) { //Si no es nulo, hay una página anterior
        paginaAnterior.href = datos.prev_page_url;
    }
    else {
        paginaAnterior.href = '#'; //Si es nulo, para que no salte error de página no encontrada, el link será el de la misma página
        paginaSiguiente.href = datos.next_page_url;
    }

    const enlaces = document.querySelectorAll('.enlaces');

    enlaces.forEach((enlace) => {
        enlace.classList.add('text-base', 'text-black', 'rounded-sm', 'border', 'border-gray-500', 'hover:bg-gray-200', 'hover:cursor-pointer');
        enlace.addEventListener('click', async (event) => {
            event.preventDefault();
            if (enlace.href != '#') {
                divProductos.innerHTML = '';
                let nuevosDatos = await obtenerProductos(enlace.href);
                mostrarProductos(nuevosDatos, divProductos);
                actualizarPaginacion(nuevosDatos, paginacion, numPagina);
            }
        });
    });
}

async function cargarProductos() {
    let datos = await obtenerProductos('/fetch-TiposProductos');
    mostrarProductos(datos, divProductos);
    mostrarPaginacion(datos, paginacion);
    actualizarPaginacion(datos, numPagina);
}

cargarProductos();