<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    <title>Sundero Sweatshirt</title>
</head>
<body>
    @include('general.header')
    <section class="relative flex flex-row">
        <div class="w-1/2 pt-4 pl-4 pr-4">
            <h1>Realización del pedido</h1>
        @if ($productosCarrito->count() == 0)
            <span>No hay productos en el carrito.</span>
        @endif
        @foreach ($productosCarrito as $productoCarrito)
            <div class="flex flex-row items-center border border-black mb-4">
                <div class="p-2">
                    <img src="{{ asset('storage/' . $productoCarrito->producto->tipoProducto->foto) }}" alt="Foto sudadera" class="w-44">
                </div>
                <div class="flex flex-col p-4">
                    <h3>Nombre: {{ $productoCarrito->producto->tipoProducto->nombre }}</h3>
                    <span>Código: {{ $productoCarrito->producto->tipoProducto->codigo }}</span>
                    <span>Categoria: {{ $productoCarrito->producto->tipoProducto->categoria->nombre }}</span>
                    <span>Talla: {{ $productoCarrito->producto->talla->nombre }}</span>
                    <span>Color: {{ $productoCarrito->producto->color->nombre }}</span>
                    <span>Cantidad: {{ $productoCarrito->cantidad }}</span>
                    <span>Precio unidad: {{ $productoCarrito->producto->tipoProducto->precio }} €</span>
                </div>
                <div>
                    <a href="{{route('productos.show', $productoCarrito->producto->id)}}"><button>Ver más</button></a>
                </div>
            </div>
        @endforeach
        </div>
        <div class="w-1/2 p-8">
            <form action="{{route('pedidos.store')}}" method="post">
                @csrf
                <h2>Pedido</h2>
                <div>
                    @php
                    $iva = $precioTotal * 21/100;
                    $total = $precioTotal + $iva;
                    @endphp
                    <input type="hidden" name="precio_total" value="{{ $precioTotal }}">
                    <div class="flex flex-row justify-between">
                        <span>Subtotal</span>
                        <span>{{$precioTotal}} €</span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span>Envío</span>
                        <span>4.99 €</span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span>IVA</span>
                        <span>{{number_format($iva, 2)}} €</span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span>Total</span>
                        <span>{{number_format($total, 2)}} €</span>
                    </div>
                </div>
                <div>
                    <span>Selecciona un método de pago:</span>
                    <div class="flex flex-row justify-center gap-2">
                        <img src="{{ asset('icons/general/visa.svg') }}" alt="Pago con VISA" class="w-10">
                        <img src="{{ asset('icons/general/paypal.svg') }}" alt="Pago con paypal" class="w-10">
                    </div>
                </div>
                <div>
                    <div>
                        <label for="titular">Titular de la tarjeta:</label>
                        <input type="text" name="titular" id="titular" required>
                    </div>
                    <div>
                        <label for="numeroTarjeta">Número de tarjeta:</label>
                        <input type="text" name="numeroTarjeta" id="numeroTarjeta" required>
                    </div>
                    <div>
                        <label for="fechaCaducidad">Fecha de vencimiento:</label>
                        <input type="date" name="fechaCaducidad" id="fechaCaducidad" required>
                    </div>
                    <div>
                        <label for="codigoSeguridad">Código de seguridad (CVV):</label>
                        <input type="number" name="codigoSeguridad" id="codigoSeguridad" required>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Realizar pedido">
                </div>
            </form>
        </div>
    </section>
    @include('general.footer')
</body>
</html>