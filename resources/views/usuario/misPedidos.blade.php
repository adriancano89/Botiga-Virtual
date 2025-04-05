<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    <title>Mis Pedidos</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1 class="text-xl font-bold">Mis pedidos</h1>
            </section>
            <section class="contenido">
                <div class="busqueda-filtros">
                    <div class="buscador">
                        <input type="search" name="buscarPedidos" id="buscarPedidos" placeholder="Buscar pedidos..." class="border-2 border-gray p-2">
                    </div>
                    <div class="filtros">
                        <div class="filtro">
                            <img src="{{asset('icons/general/filtrar.svg')}}" alt="Filtrar por">
                            <select name="filtrar" id="filtrar">
                                <option value="" disabled selected>Filtrar por</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="finalizado">Finalizado</option>
                                <option value="fecha">Fecha compra</option>
                            </select>
                        </div>
                        <div class="filtro">
                            <img src="{{asset('icons/general/ordenar.svg')}}" alt="Ordenar por">
                            <select name="ordenar" id="ordenar">
                                <option value="" disabled selected>Ordenar por</option>
                                <option value="importe">Importe</option>
                                <option value="fecha">Fecha compra</option>
                                <option value="estado">Estado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="seccion-tabla" id="pedidos">
                    <table>
                        <tr class="fondo-primario">
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
                                <td class="text-center">{{$pedido->fecha_envio ? $pedido->fecha_envio : 'Por determinar'}}</td>
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
                    {{ $pedidos->links() }}
                </div>
            </section>
        </section>
    </div>
    @include('general.footer')
</body>
</html>