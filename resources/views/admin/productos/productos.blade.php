<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css', 'resources/css/productos.css'])
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/productos/mostrarProductos.js') }}" defer></script>
    <title>Administrar | Productos</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Productos</h1>
                <a href="{{route('tiposProductos.create')}}"><button class="btn-crear fondo-secundario">Añadir nuevo producto</button></a>
            </section>
            <section class="contenido">
                <div class="busqueda-filtros">
                    <div class="buscador">
                        <input type="search" name="busqueda" id="buscarProductos" placeholder="Buscar productos...">
                    </div>
                    <div class="filtros">
                        <div class="filtro">
                            <img src="{{asset('icons/general/filtrar.svg')}}" alt="Filtrar por">
                            <select name="filtrar" id="filtrar">
                                <option value="" disabled selected>Filtrar por</option>
                                <option value="todos">Todos</option>
                                <option value="precio_bajo">Menos de 25 €</option>
                                <option value="precio_medio">Entre 25 € y 50 €</option>
                                <option value="precio_alto">Más de 50 €</option>
                            </select>
                        </div>
                        <div class="filtro">
                            <img src="{{asset('icons/general/ordenar.svg')}}" alt="Ordenar por">
                            <select name="ordenar" id="ordenar">
                                <option value="" selected>Ordenar por</option>
                                <option value="precio_asc">Precio: de menor a mayor</option>
                                <option value="precio_desc">Precio: de mayor a menor</option>
                                <option value="nombre">Nombre</option>
                                <option value="codigo">Código</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row flex-wrap gap-2 p-2" id="productos">
                    <div class="loader centrado mt-32" id="animacionCarga">
                        <div class="orbe" style="--index: 0"></div>
                        <div class="orbe" style="--index: 1"></div>
                        <div class="orbe" style="--index: 2"></div>
                        <div class="orbe" style="--index: 3"></div>
                        <div class="orbe" style="--index: 4"></div>
                    </div>
                </div>
                <div class="paginacion" id="paginacion">
                    
                </div>
            </section>
        </section>
    </div>
    @include('general.footer')
</body>
</html>