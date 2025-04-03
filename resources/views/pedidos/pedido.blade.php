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
    <section class="relative flex flex-row">
        <div class="w-2/3 pt-4 pl-4 pr-4">
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
                    <a href="{{route('productos.show', $productoCarrito->producto->id)}}"><button>Ver Producto</button></a>
                </div>
            </div>
        @endforeach
        </div>
        <div class="w-1/3 p-8">
            <form action="{{ route('pedidos.store') }}" method="post" id="formPedido">
                @csrf
                <h2>Pedido</h2>
                <div id="detallesPedido">
                    @php
                    $iva = $precioTotal * 21/100;
                    $total = $precioTotal + $iva + 4.99;
                    @endphp
                    <div class="flex flex-row justify-between">
                        <span>Subtotal</span>
                        <span id="subtotal">{{ $precioTotal }} €</span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span>Envío</span>
                        <span>4.99 €</span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span>IVA</span>
                        <span id="iva">{{ number_format($iva, 2) }} €</span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span>Total</span>
                        <span id="total">{{ number_format($total, 2) }} €</span>
                    </div>
                </div>
                <div>
                    <label for="card-element">Detalles de la tarjeta</label>
                    <div id="card-element" class="mt-2">
                        <!-- Elemento de Stripe donde se monta el campo de la tarjeta -->
                    </div>
                    <div id="card-errors" role="alert"></div>
                </div>
                <div>
                    <div id="divCupon">
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