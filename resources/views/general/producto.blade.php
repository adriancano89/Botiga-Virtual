<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/productos/cantidadProductos.js') }}" defer></script>
    <script src="{{ asset('js/productos/canvas.js') }}" defer></script>
    <script src="{{ asset('js/carrito/carrito.js') }}" defer></script>
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    <title>{{$tipoProducto->nombre}} - SUNDERO Sweatshirt</title>
</head>
<body>
    @include('general.header')
    <section class="relative bg-gray-50 py-8">
        <div class="max-w-screen-xl mx-auto px-6 flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">

            <div class="flex-shrink-0 w-full md:w-1/2 flex justify-center">
                @if($tipoProducto->foto)
                    <img src="{{ asset('storage/' . $tipoProducto->foto) }}" alt="Imagen del producto" id="imagenSudadera" class="w-full max-w-md rounded-lg shadow-lg object-cover">
                @else
                    <span class="text-gray-500">No hay imagen disponible</span>
                @endif
            </div>

            <div class="flex flex-col w-full md:w-2/3 space-y-4">
                <h1 class="text-3xl font-semibold color-letra-primario">{{ $tipoProducto->nombre }}</h1>
                <span class="text-lg text-gray-600">{{ $tipoProducto->categoria->nombre }}</span>
                <span class="text-lg text-gray-600">{{ $tipoProducto->codigo }}</span>
                <span class="text-xl font-bold color-letra-secundaria">{{ $tipoProducto->precio }} €</span>

                <form action="{{ route('carrito.store') }}" method="POST" enctype="multipart/form-data" id="formularioAnadirCarrito" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label for="talla_id" class="text-md text-gray-700">Talla</label>
                        <select name="talla_id" id="talla_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0983AC]">
                            <option value="" disabled selected>-- Seleccionar --</option>
                            @foreach ($tallas as $talla)
                                @php
                                    $coincidencia = false;
                                @endphp
                                @foreach ($filasStock as $producto)
                                    @if($producto->talla->nombre == $talla->nombre)
                                        @php
                                            $coincidencia = true;
                                        @endphp
                                    @endif
                                @endforeach
                                <option value="{{$talla->id}}" {{$coincidencia ? '' : 'disabled'}}>{{$talla->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="color_id" class="text-md text-gray-700">Color</label>
                        <select name="color_id" id="color_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0983AC]">
                            <option value="" disabled selected>-- Seleccionar --</option>
                            @foreach ($colores as $color)
                                @php
                                    $coincidencia = false;
                                @endphp
                                @foreach ($filasStock as $producto)
                                    @if($producto->color->nombre == $color->nombre)
                                        @php
                                            $coincidencia = true;
                                        @endphp
                                    @endif
                                @endforeach
                                <option value="{{$color->id}}" {{$coincidencia ? '' : 'disabled'}}>{{$color->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="cantidad" class="text-md text-gray-700">Cantidad</label>
                        <select name="cantidad" id="cantidad" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0983AC]">
                            <option value="" disabled selected>-- Selecciona Talla y Color --</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="fotoPersonalizada" class="text-md text-gray-700">Foto Personalizada</label>
                        <input type="checkbox" name="fotoPersonalizada" class="h-5 w-5">
                    </div>

                    <input type="hidden" name="tipos_producto_id" id="tipos_producto_id" value="{{$tipoProducto->id}}">

                    <button type="submit" class="w-full py-3 fondo-secundario text-white text-lg rounded-lg hover:bg-[#076b8d] transition duration-300">
                        Añadir al carrito
                    </button>
                </form>

                <div class="space-y-2">
                    <h2 class="text-lg font-semibold">Imágenes adicionales</h2>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($imagenes as $imagen)
                            <img src="{{ asset('storage/' . $imagen->url) }}" alt="Imagen del producto" class="w-24 h-24 object-cover rounded-lg shadow-md hover:opacity-80 hover:cursor-pointer transition duration-200">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 px-6 max-w-screen-xl mx-auto">
            <h2 class="text-2xl font-semibold text-gray-800">Descripción</h2>
            <p class="text-gray-700 mt-4">{{ $tipoProducto->descripcion }}</p>
        </div>

        @if($tipoProducto->foto)
        <div class="mt-12 px-6 max-w-screen-xl mx-auto">
            <h2 class="text-2xl font-semibold text-gray-800">Personalizar producto</h2>
            <div class="mt-6 flex flex-col md:flex-row md:space-x-8 space-y-6 md:space-y-0">
                <div class="w-full md:w-1/2">
                    <canvas id="canvas" class="border rounded-lg"></canvas>
                </div>

                <div class="w-full md:w-1/2 space-y-4">
                    <div>
                        <label for="color" class="text-sm text-gray-700">Color</label>
                        <input type="color" name="color" id="color" class="w-full p-1 h-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0983AC]">
                    </div>
                    <div>
                        <label for="grosor" class="text-sm text-gray-700">Grosor</label>
                        <input type="range" name="grosor" id="grosor" min="1" max="20" class="w-full">
                        <span id="valorGrosor" class="text-md font-semibold text-gray-600">1</span>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button class="fondo-cuaternario p-2 rounded-lg text-white hover:bg-gray-500 transition duration-200" id="limpiar">Borrar</button>
                        <button class="fondo-secundario text-white py-2 px-4 rounded-lg hover:bg-[#076b8d] transition duration-200" id="guardar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>
    @include('general.footer')
</body>
</html>