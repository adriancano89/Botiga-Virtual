const divProductos = document.getElementById('productos');
const divPaginacion = document.getElementById('paginacion');
const buscarProductos = document.getElementById('buscarProductos');
const filtrar = document.getElementById('filtrar');
const ordenar = document.getElementById('ordenar');
const animacionCarga = document.getElementById('animacionCarga');

async function obtenerProductos(pagina) {
    let dataBusqueda = {
        "busqueda": buscarProductos.value.trim(),
        "filtrar" : filtrar.value,
        "ordenar" : ordenar.value
    }
    let data = await enviarDatos(pagina, dataBusqueda, 'POST', 'Error al obtener los productos');
    return data;
}

function dibujarProductos(dataProductos) {
    for (let clave in dataProductos) {
        let datosProducto = dataProductos[clave];
        let id = datosProducto.id;
        let codigo = datosProducto.codigo;
        let nombre = datosProducto.nombre;
        let precio = datosProducto.precio;
        divProductos.innerHTML += `
        <a href="productos/${id}">
            <div class="producto">
                <div class="flex flex-row">
                    <img src="icons/general/con-capucha.png" alt="imagen producto" class="imagen-producto">
                    <a href='tiposProductos/${id}/edit'><img src="icons/general/editar.png" alt="editar producto" class="icono-accion" title="Editar producto"></a>
                    <img src="icons/general/papelera.png" alt="eliminar producto" class="icono-accion" title="Eliminar producto">
                </div>
                <h2 class="nombre-producto">${nombre}</h2>
                <span class="codigo-producto">${codigo}</span>
                <div class="apartado-precio-stock">
                    <span class="color-letra-secundaria precio">${precio} €</span>
                    <div class="flex flex-row">
                        <a href='productos/${id}/edit'> 
                            <img src="icons/general/mas.png" alt="añadir stock" class="icono-anadir-stock" title="Añadir stock">
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
        divProductos.innerHTML = "<span class='centrado'>No se han encontrado productos.</span>";
    }
    
}

function indicarPagina(enlace) {
    enlace.classList.remove('text-black');
    enlace.classList.add('bg-[#0983AC]', 'text-white');
}

function mostrarAnimacionCarga() {
    animacionCarga.classList.remove('hidden');
}

function ocultarAnimacionCarga() {
    animacionCarga.classList.add('hidden');
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
        mostrarAnimacionCarga();
        let datos = await obtenerProductos(enlace.href);
        ocultarAnimacionCarga();
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

async function cargarProductos(url) {
    mostrarAnimacionCarga();
    let datos = await obtenerProductos(url);
    ocultarAnimacionCarga();
    mostrarProductos(datos);
    restablecerPaginacion();
    mostrarPaginacion(datos.productos.links);
    actualizarPaginacion(datos.productos);
}

buscarProductos.addEventListener('input', function() {
    cargarProductos('/fetch-TiposProductos');
});

filtrar.addEventListener('input', function() {
    cargarProductos('/fetch-TiposProductos');
});

ordenar.addEventListener('input', function() {
    cargarProductos('/fetch-TiposProductos');
});

cargarProductos('/fetch-TiposProductos', '');
