<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/css/concurso.css', 'resources/css/productos.css'])
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/concurso.js') }}" defer></script>
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    <title>SUNDERO Sweatshirt</title>
</head>
<body>
    @include('general.header')
    <section class="px-4 py-6">
        <div class="flex flex-col items-center">
            <div class="relative inline-block mt-4 mb-4 w-full md:w-[80%]">
                <div class="absolute top-1/2 left-0 transform -translate-y-1/2 w-full sm:w-3/4 md:w-1/2 text-white text-left pl-6">
                    <h2 class="font-bold text-2xl md:text-3xl text-white">Categoria Urban | Capucha | Hombre</h2>
                    <p class="mt-4 mb-8 text-white">Descubre nuestras sudaderas premium diseñadas para ofrecer estilo y comodidad.</p>
                    <a href="/categorias/genero/Urban | Capucha | Hombre" class="text-black font-bold bg-[#F2E984] rounded-3xl p-[12px]"><button>¡Compra ahora!</button></a>
                </div>
                <img src="{{ asset('icons/general/imagen-pagina-principal.svg') }}" alt="imagen" class="rounded-3xl w-full object-cover">
            </div>
        </div>


        <div>
            <div class="mt-4 mb-8">
                <h2 class="text-xl font-semibold color-letra-primario mb-6">Categorias</h2>
                @foreach ($categorias as $categoria)
                    <a href="{{ route('categoria.show', $categoria->id) }}" class="block w-full md:w-1/3">
                        <div class="shadow-xl rounded-[15px] p-4 hover:bg-slate-300 hover:cursor-pointer mb-4">
                            <span class="text-gray-500">{{ $categoria->nombre }}</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <h1 class="text-xl md:text-2xl font-semibold color-letra-primario mb-6">Productos destacados</h1>

            <div class="flex flex-col md:flex-row md:justify-between mb-6">
                <form action="{{ route('tiposProductos.destacados') }}" method="GET" class="w-full">
                    <div class="buscador flex flex-row gap-2 mb-4 sm:mb-0 w-full md:w-1/3">
                        <input type="search" name="busqueda" id="buscarProductos" placeholder="Buscar productos..." class="sm:w-auto">
                        <button type="submit" class="fondo-cuaternario text-white px-4 py-1 rounded-md">Buscar</button>
                    </div>
                </form>

                <div class="filtros justify-center">
                    <div class="filtro">
                        <img src="{{asset('icons/general/filtrar.svg')}}" alt="Filtrar por">
                        <select name="filtrar" id="filtrar" class="p-2 rounded-md">
                            <option value="" disabled selected>Filtrar por</option>
                            <option value="todos">Todos</option>
                            <option value="categoria">Categoria</option>
                        </select>
                    </div>
                    <div class="filtro">
                        <img src="{{asset('icons/general/ordenar.svg')}}" alt="Ordenar por">
                        <select name="ordenar" id="ordenar" class="p-2 rounded-md">
                            <option value="" disabled selected>Ordenar por</option>
                            <option value="precio">Precio</option>
                        </select>
                    </div>
                </div>
            </div>
            @if($productos->isEmpty())
                <span>No se han encontrado resultados.</span>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-items-center">
                @foreach ($productos as $producto)
                    <a href="{{ route('productos.show', $producto->id) }}">
                        <div class="producto shadow-xl rounded-[15px] p-4 hover:bg-slate-300 hover:cursor-pointer">
                            @if ($producto->foto)
                                <img src="{{ asset('storage/' . $producto->foto) }}" alt="imagen producto" class="imagen-producto rounded-lg object-cover mx-auto">
                            @else
                                <img src="{{ asset('icons/general/con-capucha.png') }}" alt="imagen producto" class="imagen-producto rounded-lg object-cover mx-auto">
                            @endif
                            <h2 class="nombre-producto color-letra-primario mt-4 text-center">{{ $producto->nombre }}</h2>
                            <span class="text-gray-400 mt-4">{{ $producto->categoria->nombre }}</span>
                            <div class="flex justify-between items-center mt-1 w-full">
                                <span class="codigo-producto">{{ $producto->codigo }}</span>
                                <span class="precio color-letra-secundaria text-lg font-bold whitespace-nowrap">{{ $producto->precio }} €</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @endif

            <div class="flex justify-end mt-6">
                {{ $productos->links() }}
            </div>
        </div>
    </section>

    @if ($mostrarJuego)
        <div id="concurso" class="fondo-primario justify-center">
            <div id="infoJuego" class="text-white text-xl text-center">
                <h2 class='text-3xl'>¡Bienvenido/a a SUNDERO SWEATSHIRT!</h2>
                <h3>¡¡Juega para ganar un premio!!</h3>
                <h4>Instrucciones:</h4>
                <ul>
                    <li>Arrastra el cubo hacia la zona blanca</li>
                    <li>Debes superar el nivel 3 para ganar</li>
                    <li>Si haces 3 fallos, quedarás eliminado</li>
                </ul>
                <button id="jugar" class="btn-juego">¡Empezar!</button>
            </div>
        </div>
    @endif
    @include('general.footer')
</body>
</html>