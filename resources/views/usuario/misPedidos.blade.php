<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    <title>Mis Pedidos</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="w-[85%] p-4">
            <div class="flex flex-row justify-between items-center p-2">
                <h1 class="text-xl font-bold">Mis pedidos</h1>
            </div>
            <div>
                <div class="flex flex-row justify-between p-2">
                    <div>
                        <input type="search" name="buscarPedidos" id="buscarPedidos" placeholder="Buscar pedidos..." class="border-2 border-gray p-2">
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
                <div class="flex flex-col gap-6" id="pedidos">
                    <table>
                        <tr>
                            <th>Precio final</th>
                            <th>Fecha de compra</th>
                            <th>Fecha de envío</th>
                            <th>Fecha de entrega</th>
                            <th>Ver pedido</th>
                            <th>Ver factura</th>
                        </tr>
                        @foreach ($pedidos as $pedido)
                            <tr class="bg-{{ $pedido->estado == 0 ? '[#DCFCE7]' : '[#C9C9C9]' }}">
                                <td class="text-center">{{$pedido->precio_total}} €</td>
                                <td class="text-center">{{$pedido->fecha_venta}}</td>
                                <td class="text-center">{{$pedido->fecha_envio}}</td>
                                <td class="text-center">{{$pedido->fecha_entrega ? $pedido->fecha_entrega : 'Por determinar'}}</td>
                                <td>
                                    <div class="flex flex-row justify-center">
                                        <a href="{{route('pedidos.show', $pedido->id)}}">
                                            <img src="{{asset('icons/general/ojo.png')}}" alt="Ver detalles del pedido" class="w-8 h-8 mt-2" title="Ver pedido">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-row justify-center">
                                        <a href="{{route('imprimirFactura', $pedido->id)}}" target="_blank">
                                            <img src="{{asset('icons/general/cuenta.png')}}" alt="Ver factura del pedido" class="w-8 h-8 mt-2" title="Ver factura">
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="flex flex-row justify-end gap-2" id="paginacion">
                    
                </div>
            </div>
        </section>
    </div>
    @include('general.footer')
</body>
</html>