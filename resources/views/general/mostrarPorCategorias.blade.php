<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/productos.css'])
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    <title>{{ $categoria->nombre }} - SUNDERO Sweatshirt</title>
</head>
<body>
    @include('general.header')
    <section class="px-4 py-6">
        <h1 class="text-xl md:text-xl font-semibold color-letra-primario mb-6">Categoría: {{ $categoria->nombre }}</h1>
        <div class="flex flex-col space-y-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-items-center">
            @foreach ($productosCategoria as $productoCategoria)
                <a href="{{ route('productos.show', $productoCategoria->id) }}">
                    <div class="producto">
                        @if ($productoCategoria->foto)
                            <img src="{{ asset('storage/' . $productoCategoria->foto) }}" alt="imagen producto" class="imagen-producto rounded-lg object-cover mx-auto">
                        @else
                            <img src="{{ asset('icons/general/con-capucha.png') }}" alt="imagen producto" class="imagen-producto rounded-lg object-cover mx-auto">
                        @endif
                        <h2 class="nombre-producto color-letra-primario mt-4">{{ $productoCategoria->nombre }}</h2>

                        <div class="flex justify-between items-center mt-1">
                            <span class="codigo-producto">{{ $productoCategoria->codigo }}</span>
                            <span class="precio color-letra-secundaria text-lg font-bold  whitespace-nowrap">{{ $productoCategoria->precio }} €</span>
                        </div>
                    </div>
                </a>
            @endforeach
            </div>
            <div class="flex justify-center mt-6">
                {{ $productosCategoria->links() }}
            </div>
        </div>
    </section>
    @include('general.footer')
</body>
</html>