<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/carrito/mostrarCarrito.js') }}" defer></script>
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    <title>Carrito</title>
</head>
<body>
    @include('general.header')
        <div class="flex flex-row bg-[#E7F0F0]">
            <section class="w-[100%] p-4">
                <div class="flex flex-row justify-between items-center">
                    <h1 class="text-xl font-bold p-4">Carrito de la Compra</h1>
                </div>
                
                <div class="flex flex-row justify-between">
                    @if ($productosEnCarrito)
                        <div id="tablaCarrito" class="w-[65%] p-4">
                            @foreach($productosEnCarrito as $productoEnCarrito)
                                <div class="shadow-xl rounded-[15px] p-4 bg-white text-center flex space-x-4 mt-5">
                                    <div class="w-[25%] p-1 flex justify-center items-center">
                                        <img src="{{ asset('storage/' . $productoEnCarrito->producto->tipoProducto->foto) }}" alt="imagen sudadera {{$productoEnCarrito->producto->tipoProducto->nombre}}">
                                    </div>
                                    <div class="w-[75%] p-1">
                                        <!-- Fila 1: Nombre del producto y botón de eliminar -->
                                        <div class="flex justify-between items-center">
                                            <div class="w-[80%] p-1 text-left text-2xl">{{$productoEnCarrito->producto->tipoProducto->nombre}}</div>
                                            <div class="w-[20%] p-1 text-right">
                                                <form action="{{ route('destroy', $productoEnCarrito->id) }}" method="POST" class="flex justify-end">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="hover:cursor-pointer">
                                                        <img src="{{ asset('icons/general/borrar.png') }}" alt="Eliminar Producto del Carrito" class="w-[25px]">
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Fila 2: Categoría y Ver Producto -->
                                        <div class="flex justify-between items-center">
                                            <div class="w-[50%] p-1 text-left text-lm text-[#4B5563]">
                                                {{$productoEnCarrito->producto->tipoProducto->categoria->nombre}}
                                            </div>
                                            <div class="w-[50%] p-1 text-right color-letra-secundaria flex justify-end">
                                                <a href="{{route('productos.show', $productoEnCarrito->producto->id)}}" target="_blank">
                                                    <button class="flex items-center">
                                                        <img src="icons/general/ojo.png" alt="Ver Producto" class="w-6 h-6 mr-2">
                                                        Ver Producto
                                                    </button>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Fila 3: Color, Talla, Cantidad, Precio -->
                                        <div class="flex justify-between mt-5">
                                            <div class="w-[20%] p-1">Color</div>
                                            <div class="w-[20%] p-1">Talla</div>
                                            <div class="w-[20%] p-1">Cantidad</div>
                                            <div class="w-[20%] p-1">Precio</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="w-[20%] p-1">
                                                <div class="rounded-[100px]" style="background-color: {{$productoEnCarrito->producto->color->hexadecimal}}; height: 20px;"></div>
                                            </div>
                                            <div class="w-[20%] p-1">{{$productoEnCarrito->producto->talla->nombre}}</div>
                                            <div class="w-[20%] p-1">
                                                <select name="cantidad" id="{{ $productoEnCarrito->id }}" class="cantidades">
                                                    @for ($i = 1; $i <= $productoEnCarrito->producto->stock; $i++)
                                                        <option value="{{ $i }}" {{ $i == $productoEnCarrito->cantidad ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="w-[20%] p-1">{{$productoEnCarrito->producto->tipoProducto->precio}} €</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div id="tablaCarritoLS">
                            <tr class="w-full shadow-xl rounded-[15px] p-4 hover:bg-slate-300 hover:cursor-pointer">
                                <th class="border-2 border-[#131620] text-center">Nombre</th>
                                <th class="border-2 border-[#131620] text-center">Talla</th>
                                <th class="border-2 border-[#131620] text-center">Color</th>
                                <th class="border-2 border-[#131620] text-center">Cantidad</th>
                                <th class="border-2 border-[#131620] text-center">Precio</th>
                                <th class="border-2 border-[#131620] text-center">Eliminar</th>
                            </tr>
                        </div>
                    @endif
                    <div class="flex flex-col w-[25%] p-4 shadow-xl rounded-[15px] bg-white text-center space-y-4 mt-9 max-h-[350px] overflow-y-auto">
                        <b class="text-left text-2xl">Pedido</b>
                        <div class="flex flex-col space-y-2">
                            <div class="flex justify-between">
                                <span>Envio</span>
                                <span>4.99 €</span>
                            </div>
                            <div class="flex justify-between">
                                <span>IVA</span>
                                @php
                                    $iva = $precioTotal * 0.21;
                                    $iva = number_format($iva, 2);
                                @endphp
                                <span>{{ $iva }} €</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span>{{ number_format($precioTotal, 2) }} €</span>
                            </div>
                            <div class="flex justify-between">
                                <b class="text-left text-xl">Total</b>
                                @php
                                    $precioTotalTotal = $precioTotal + 4.99 + $iva;
                                @endphp
                                <b class="text-left text-xl">{{ number_format($precioTotalTotal, 2) }} €</b>
                            </div>
                        </div>
                        <a href="{{route('pedidos.create')}}">
                            <button class="py-2 w-full text-white fondo-secundario rounded-md fondo-primario-hover mt-5">Realizar Pedido</button>
                        </a>
                        <div class="flex flex-row justify-center space-x-2">
                            <img src="{{ asset('icons/general/candado.svg') }}" alt="Pago con VISA" class="w-6">
                            <img src="{{ asset('icons/general/visa.svg') }}" alt="Pago con PayPal" class="w-10">
                            <img src="{{ asset('icons/general/mastercard.svg') }}" alt="Pago con VISA" class="w-10">
                            <img src="{{ asset('icons/general/american_expres.svg') }}" alt="Pago con PayPal" class="w-10">
                            <img src="{{ asset('icons/general/paypal.svg') }}" alt="Pago con VISA" class="w-10">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @include('general.footer')
</body>
</html>