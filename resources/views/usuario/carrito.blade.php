<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
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
                        <span>Existen productos en el carrito</span>
                        <div class="">
                            <table>
                                <tr class="border-2 border-[#131620]">
                                    <th class="border-2 border-[#131620] text-center">Nombre</th>
                                    <th class="border-2 border-[#131620] text-center">Talla</th>
                                    <th class="border-2 border-[#131620] text-center">Color</th>
                                    <th class="border-2 border-[#131620] text-center">Cantidad</th>
                                    <th class="border-2 border-[#131620] text-center">Eliminar</th>
                                </tr>
                                @foreach($productosEnCarrito as $productoEnCarrito)
                                    <tr class="border-2 border-[#131620]">
                                        <td class="border-2 border-[#131620] text-center">{{$productoEnCarrito->producto->tipoProducto->nombre}}</td>
                                        <td class="border-2 border-[#131620] text-center">{{$productoEnCarrito->producto->talla->nombre}}</td>
                                        <td class="border-2 border-[#131620] text-center">{{$productoEnCarrito->producto->color->nombre}}</td>
                                        <td class="border-2 border-[#131620] text-center">{{$productoEnCarrito->cantidad}}</td>
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
                        <span>No hay productos en el carrito</span>
                    @endif
                </div>
            </section>
        </div>
    @include('general.footer')
</body>
</html>