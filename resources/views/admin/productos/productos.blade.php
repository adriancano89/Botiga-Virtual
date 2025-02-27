<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/productos/mostrarProductos.js') }}" defer></script>
    <title>Administrar | Productos</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="w-[85%] p-4">
            <div class="flex flex-row justify-between items-center p-2">
                <h1 class="text-xl font-bold">Productos</h1>
                <a href="{{route('tiposProductos.create')}}"><button>Añadir nuevo producto</button></a>
            </div>
            <div>
                <div class="flex flex-row justify-between p-2">
                    <div>
                        <input type="search" name="buscarProductos" id="buscarProductos" placeholder="Buscar productos..." class="border-2 border-gray p-2">
                    </div>
                    <div class="flex flex-row gap-2">
                        <div>
                            <img src="" alt="">
                            <span>Filtrar</span>
                        </div>
                        <div>
                            <img src="" alt="">
                            <span>Ordenar por</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row flex-wrap gap-2 p-2" id="productos">
                    
                </div>
                <div class="flex flex-row justify-end gap-2" id="paginacion">
                    <a href="" id="paginaAnterior" class="enlaces p-2">&laquo Anterior</a>
                    <a href="" id="paginaSiguiente" class="enlaces p-2">Siguiente &raquo</a>
                </div>
            </div>
        </section>
    </div>
    @include('general.footer')
</body>
</html>