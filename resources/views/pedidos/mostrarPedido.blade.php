<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    <title>Productos del pedido</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="w-[85%] p-4">
            <div class="flex flex-row justify-between items-center p-2">
                <h1 class="text-xl font-bold">Productos del pedido</h1>
            </div>
            <div>
                <div class="flex flex-row justify-between p-2">
                    <div>
                        <input type="search" name="buscarProducto" id="buscarProducto" placeholder="Buscar productos..." class="border-2 border-gray p-2">
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
                <div class="flex flex-row flex-wrap gap-6" id="pedidos">
                @foreach ($pedido->productosPedido as $productoPedido)
                    @php
                        $producto = $productoPedido->producto;
                        $tipoProducto = $productoPedido->producto->tipoProducto;
                    @endphp
                    <article class="w-1/3 flex flex-row items-center rounded-xl shadow-xl p-4">
                        <div>
                            <img src="{{ asset('storage/' . $productoPedido->producto->tipoProducto->foto) }}" alt="Imagen del producto" class="w-24">
                        </div>
                        <div class="flex flex-col p-4">
                            <h3>{{$tipoProducto->nombre}}</h3>
                            <span>{{$tipoProducto->codigo}}</span>
                            <span>{{$tipoProducto->categoria->nombre}}</span>
                            <div class="flex flex-row justify-between">
                                <div class="flex flex-col">
                                    <span>Color:</span>
                                    <span>{{$producto->color->nombre}}</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <span>Talla:</span>
                                    <span>{{$producto->talla->nombre}}</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <span>Cantidad:</span>
                                    <span>{{$productoPedido->cantidad}}</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <span>Precio:</span>
                                    <span>{{$tipoProducto->precio * $productoPedido->cantidad}} €</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{route('productos.show', $producto->id)}}" target="_blank">
                                <img src="{{asset('icons/general/ojo.png')}}" alt="Ver producto" class="w-8 h-8 mt-2" title="Ver producto">
                            </a>
                        </div>
                    </article>
                @endforeach
                </div>
                <div class="flex flex-row justify-end gap-2" id="paginacion">
                    
                </div>
            </div>
        </section>
    </div>
    @include('general.footer')
</body>
</html>