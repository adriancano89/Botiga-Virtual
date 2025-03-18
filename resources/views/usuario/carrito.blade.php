<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/carrito/mostrarCarrito.js') }}" defer></script>
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    <title>Carrito</title>
</head>
<body>
    @include('general.header')
        <div class="flex flex-row">
            @include('usuario.barraLateral')
            <section class="w-[85%] p-4">
                <div class="flex flex-row justify-between items-center">
                    <h1 class="text-xl font-bold">Carrito</h1>
                </div>
                
                <div>
                    @if ($productosEnCarrito)
                        <div class="">
                            <table id="tablaCarrito">
                                <tr class="border-2 border-[#131620]">
                                    <th class="border-2 border-[#131620] text-center">Nombre</th>
                                    <th class="border-2 border-[#131620] text-center">Talla</th>
                                    <th class="border-2 border-[#131620] text-center">Color</th>
                                    <th class="border-2 border-[#131620] text-center">Cantidad</th>
                                    <th class="border-2 border-[#131620] text-center">Precio</th>
                                    <th class="border-2 border-[#131620] text-center">Eliminar</th>
                                </tr>
                                @foreach($productosEnCarrito as $productoEnCarrito)
                                    <tr class="border-2 border-[#131620]">
                                        <td class="border-2 border-[#131620] text-center">{{$productoEnCarrito->producto->tipoProducto->nombre}}</td>
                                        <td class="border-2 border-[#131620] text-center">{{$productoEnCarrito->producto->talla->nombre}}</td>
                                        <td class="border-2 border-[#131620] text-center">{{$productoEnCarrito->producto->color->nombre}}</td>
                                        <td class="border-2 border-[#131620] text-center">{{$productoEnCarrito->cantidad}}</td>
                                        <td class="border-2 border-[#131620] text-center">{{$productoEnCarrito->producto->tipoProducto->precio * $productoEnCarrito->cantidad}}</td>
                                        <td class="border-2 border-[#131620]">
                                            <form action="{{ route('destroy', $productoEnCarrito->id) }}" method="POST" class="flex flex-row justify-center">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="hover:cursor-pointer">
                                                    <img src="{{ asset('icons/general/papelera.png') }}" alt="Eliminar Producto del Carrito" class="w-[25px]">
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @else
                        <div>
                            <table id="tablaCarritoLS">
                                <tr class="border-2 border-[#131620]">
                                    <th class="border-2 border-[#131620] text-center">Nombre</th>
                                    <th class="border-2 border-[#131620] text-center">Talla</th>
                                    <th class="border-2 border-[#131620] text-center">Color</th>
                                    <th class="border-2 border-[#131620] text-center">Cantidad</th>
                                    <th class="border-2 border-[#131620] text-center">Precio total</th>
                                    <th class="border-2 border-[#131620] text-center">Eliminar</th>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    @include('general.footer')
</body>
</html>