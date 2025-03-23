const divProductos = document.getElementById('productos');
const divPaginacion = document.getElementById('paginacion');
const buscarProductos = document.getElementById('buscarProductos');

async function obtenerProductos(pagina, busqueda) {
    let dataBusqueda = {
        "busqueda": busqueda.trim()
    }
    let data = enviarDatos(pagina, dataBusqueda, 'POST', 'Error al obtener los productos');
    return data;
}

function dibujarProductos(dataProductos) {
    for (let clave in dataProductos) {
        console.log(dataProductos[clave]);
        let datosProducto = dataProductos[clave];
        let id = datosProducto.id;
        let codigo = datosProducto.codigo;
        let nombre = datosProducto.nombre;
        let precio = datosProducto.precio;
        divProductos.innerHTML += `
        <a href="productos/${id}">
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
                        <a href='productos/${id}/edit'> 
                        <img src="icons/general/mas.png" alt="añadir stock" class="w-[25px] hover:cursor-pointer" title="Añadir stock">
                        </a>
                        <span></span>
                    </div>
                </div>
            </div>
        </a>`;
    }
}

function mostrarProductos(datos) {
    console.log("Me viene desde PHP:");
    console.log(datos);

    divProductos.innerHTML = '';

    if (datos.resultados) { //Verificamos que hayan productos a mostrar
        let dataProductos = datos.productos.data;

        if (dataProductos) { //dataProductos no será nulo si no se ha hecho ninguna búsqueda
            dibujarProductos(dataProductos);
        }
        else {
            dibujarProductos(dataProductos);
        }
    }
    else {
        divProductos.innerHTML = "No se han encontrado productos";
    }
    
}

function indicarPagina(enlace) {
    enlace.classList.remove('text-black');
    enlace.classList.add('bg-[#0983AC]', 'text-white');
}

function crearEnlace(url, texto) {
    let enlace = document.createElement('a');

    enlace.href = url;
    enlace.innerHTML = texto;
    enlace.classList.add('text-base', 'text-black', 'rounded-sm', 'border', 'border-gray-500', 'p-2', 'hover:bg-gray-200', 'hover:cursor-pointer');

    if (!isNaN(texto)) { // Devuelve false si se puede convertir a número. Lo utilizamos para saber si el enlace es de un número de página
        enlace.classList.add('pagina');

        if (enlace.textContent == '1') { //Comprobamos si es 1 para marcar la primera página cuando se cargue la página
            indicarPagina(enlace);
        }
    }

    enlace.addEventListener('click', async function(event) {
        event.preventDefault();
        const enlacesPaginas = document.querySelectorAll('.pagina');
        
        if (!isNaN(enlace.textContent)) {
            indicarPagina(enlace);

            enlacesPaginas.forEach(enlacePagina => {
                if (enlacePagina.textContent != enlace.textContent) { //Si no coincide, significa que no es la página actual
                    enlacePagina.classList.remove('bg-[#0983AC]', 'text-white');
                }
            });
        }
        else {
            let pagina = enlace.href;
            let paginaAMostrar = pagina.charAt(pagina.length - 1); //Obtenemos el último caracter de la url, que es el número de página
            enlacesPaginas.forEach(enlacePagina => {
                if (enlacePagina.textContent != paginaAMostrar) { //Si no coincide, significa que no es la página que queremos mostrar
                    enlacePagina.classList.remove('bg-[#0983AC]', 'text-white');
                }
                else {
                    indicarPagina(enlacePagina);
                }
            });
        }

        let datos = await obtenerProductos(enlace.href, '');
        mostrarProductos(datos);
        actualizarPaginacion(datos.productos);
    });

    return enlace;
}

function mostrarPaginacion(links) {
    for (let clave in links) {
        if (clave != 0 && clave != links.length - 1) { // Omitimos el link de la página anterior y de la siguiente
            let link = links[clave];
            let enlacePagina = crearEnlace(link.url, link.label);
            divPaginacion.insertBefore(enlacePagina, divPaginacion.lastElementChild);
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
        paginaAnterior.href = datos.last_page_url; //Si es nulo, para que no salte error de página no encontrada, el link será el de la última página
    }

    if (datos.next_page_url) {
        paginaSiguiente.href = datos.next_page_url;
    }
    else {
        paginaSiguiente.href = datos.first_page_url; //Si es nulo, para que no salte error, el link será el de la primera página
    }
}

function restablecerPaginacion() {
    let paginaAnterior = crearEnlace('', '&laquo Anterior');
    paginaAnterior.id = 'paginaAnterior';
    let paginaSiguiente = crearEnlace('', 'Siguiente &raquo');
    paginaSiguiente.id = 'paginaSiguiente';
    divPaginacion.innerHTML = '';
    divPaginacion.appendChild(paginaAnterior);
    divPaginacion.appendChild(paginaSiguiente);
}

async function cargarProductos(url, busqueda) {
    let datos = await obtenerProductos(url, busqueda);
    mostrarProductos(datos);
    restablecerPaginacion();
    mostrarPaginacion(datos.productos.links);
    actualizarPaginacion(datos.productos);
}

buscarProductos.addEventListener('input', function() {
    const busqueda = buscarProductos.value;
    cargarProductos('/fetch-TiposProductos', busqueda);
});

cargarProductos('/fetch-TiposProductos', '');
