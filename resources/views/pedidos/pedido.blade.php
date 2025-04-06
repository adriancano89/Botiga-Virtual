<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/css/pedidos.css'])
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/pedidos/cupon.js') }}" defer></script>
    <script src="https://js.stripe.com/v3/" defer></script>
    <script src="{{ asset('js/carrito/pedido.js') }}" defer></script>
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    <title>Sundero Sweatshirt</title>
</head>
<body>
    @include('general.header')
    <section class="relative flex flex-row bg-[#E7F0F0]">
        <div class="w-2/3 pt-4 pl-4 pr-4">
            <h1 class="text-2xl">Realización del pedido</h1>
        @if ($productosCarrito->count() == 0)
            <span>No hay productos en el carrito.</span>
        @endif
        @foreach ($productosCarrito as $productoCarrito)


            <div class="shadow-xl rounded-[15px] p-4 bg-white text-center flex space-x-4 mt-5">
                <div class="w-[25%] p-1 flex justify-center items-center">
                    <img src="{{ asset('storage/' . $productoCarrito->producto->tipoProducto->foto) }}" alt="imagen sudadera {{$productoCarrito->producto->tipoProducto->nombre}}">
                </div>
                <div class="w-[75%] p-1">
                    <div class="flex justify-between items-center">
                        <div class="w-[80%] p-1 text-left text-2xl">{{$productoCarrito->producto->tipoProducto->nombre}}</div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="w-[50%] p-1 text-left text-lm text-[#4B5563]">
                            {{$productoCarrito->producto->tipoProducto->categoria->nombre}}
                        </div>
                        <div class="w-[50%] p-1 text-right color-letra-secundaria flex justify-end">
                            <a href="{{route('productos.show', $productoCarrito->producto->id)}}" target="_blank">
                                <button class="flex items-center">
                                <img src="icons/general/ojo.png" alt="Ver Producto" class="w-6 h-6 mr-2">
                                    Ver Producto
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="flex justify-between mt-5">
                        <div class="w-[20%] p-1">Color</div>
                        <div class="w-[20%] p-1">Talla</div>
                        <div class="w-[20%] p-1">Cantidad</div>
                        <div class="w-[20%] p-1">Precio</div>
                    </div>
                    <div class="flex justify-between">
                        <div class="w-[20%] p-1">
                            <div class="rounded-[100px]" style="background-color: {{$productoCarrito->producto->color->hexadecimal}}; height: 20px;"></div>
                        </div>
                        <div class="w-[20%] p-1">{{$productoCarrito->producto->talla->nombre}}</div>
                        <div class="w-[20%] p-1">{{$productoCarrito->cantidad}}</div>
                        <div class="w-[20%] p-1">{{$productoCarrito->producto->tipoProducto->precio}} €</div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <div class="flex flex-col w-1/3 p-8 shadow-xl rounded-[15px] bg-white text-center space-y-4 m-9">
            <form action="{{ route('pedidos.store') }}" method="post" id="formPedido">
                @csrf
                <b class="text-left text-2xl">Pedido</b>
                <div id="detallesPedido">
                    @php
                    $iva = $precioTotal * 21/100;
                    $total = $precioTotal + $iva + 4.99;
                    @endphp
                    <div class="flex flex-row justify-between mt-2">
                        <span>Subtotal</span>
                        <span id="subtotal">{{ $precioTotal }} €</span>
                    </div>
                    <div class="flex flex-row justify-between mt-2">
                        <span>Envío</span>
                        <span>4.99 €</span>
                    </div>
                    <div class="flex flex-row justify-between mt-2">
                        <span>IVA</span>
                        <span id="iva">{{ number_format($iva, 2) }} €</span>
                    </div>
                    <div class="flex flex-row justify-between mt-2">
                        <b class="text-left text-xl">Total</b>
                        <b id="total" class="text-left text-xl">{{ number_format($total, 2) }} €</b>
                    </div>
                </div>
                <div>
                    <label for="card-element">Detalles de la tarjeta</label>
                    <div id="card-element" class="mt-2">
                    </div>
                    <div id="card-errors" role="alert" class="mt-2"></div>
                </div>
                <div>
                    <div id="divCupon" class="mt-2">
                        <label for="cupon">Cupón de descuento:</label>
                        <input type="text" name="cupon" id="cupon">
                    </div>
                    <button type="submit" class="py-2 w-full text-white fondo-secundario rounded-md font-medium fondo-primario-hover mt-5">Pagar</button>
                </div>
            </form>
        </div>
    </section>
    @include('popups.popupError')
    @include('general.footer')
</body>
</html>