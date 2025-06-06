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
                    <form action="{{ route('usuario.misPedidos') }}" method="GET">
                        <div class="buscador">
                            <input type="search" name="busqueda" id="busqueda" placeholder="Buscar pedidos...">
                            <button type="submit" class="fondo-cuaternario btn-buscar">Buscar</button>
                        </div>
                    </form>
                    <div class="filtros">
                        <form action="{{route('usuario.misPedidos')}}" method="GET">    
                            <div class="filtro">
                                <img src="{{asset('icons/general/filtrar.svg')}}" alt="Filtrar por">
                                <select name="filtrar" id="filtrar">
                                    <option value="" disabled selected>Filtrar por</option>
                                    <option value="todos">Todas</option>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="finalizada">Finalizada</option>
                                </select>
                            </div>
                            <div class="filtro">
                                <img src="{{asset('icons/general/ordenar.svg')}}" alt="Ordenar por">
                                <select name="ordenar" id="ordenar">
                                    <option value="" selected>Ordenar por</option>
                                    <option value="precio_asc">Precio: de menor a mayor</option>
                                    <option value="precio_desc">Precio: de mayor a menor</option>
                                    <option value="fecha_venta">Fecha compra</option>
                                    <option value="fecha_envio">Fecha envío</option>
                                    <option value="fecha_entrega">Fecha entrega</option>
                                </select>
                            </div>
                            <button type="submit" class="fondo-cuaternario btn-filtrar">Filtrar</button>
                        </form>
                    </div>
                </div>
                <div class="seccion-tabla" id="pedidos">
                @if($pedidos->isEmpty())
                    <span>No se han encontrado resultados.</span>
                @else
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
                @endif
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