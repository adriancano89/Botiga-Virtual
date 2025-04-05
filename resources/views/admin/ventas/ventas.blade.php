<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <title>Administrar | Ventas</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Ventas</h1>
            </section>
            <section class="contenido">
                <div class="busqueda-filtros">
                    <div class="buscador">
                        <input type="search" name="buscarVentas" id="buscarVentas" placeholder="Buscar ventas...">
                    </div>
                    <div class="filtros">
                        <div class="filtro">
                            <img src="{{asset('icons/general/filtrar.svg')}}" alt="Filtrar por">
                            <select name="filtrar" id="filtrar">
                                <option value="" disabled selected>Filtrar por</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="finalizada">Finalizada</option>
                                <option value="fecha">Fecha venta</option>
                            </select>
                        </div>
                        <div class="filtro">
                            <img src="{{asset('icons/general/ordenar.svg')}}" alt="Ordenar por">
                            <select name="ordenar" id="ordenar">
                                <option value="" disabled selected>Ordenar por</option>
                                <option value="precio">Precio</option>
                                <option value="fecha">Fecha venta</option>
                                <option value="estado">Estado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="seccion-tabla">
                    <table>
                        <tr class="fondo-primario">
                            <th>Usuario</th>
                            <th>Precio total</th>
                            <th>Fecha venta</th>
                            <th>Fecha envío</th>
                            <th>Fecha entrega</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->usuario->email}}</td>
                                <td>{{$pedido->precio_total}} €</td>
                                <td>{{$pedido->fecha_venta}}</td>
                                <td>{{$pedido->fecha_envio ? $pedido->fecha_envio : 'Sin determinar'}}</td>
                                <td>{{$pedido->fecha_entrega ? $pedido->fecha_entrega : 'Sin determinar'}}</td>
                                @if ($pedido->estado)
                                    <td class="p-3"><span class="bg-[#C9C9C9]">Finalizado</span></td>
                                @else
                                    <td class="p-3"><span class="bg-[#DCFCE7]">Pendiente</span></td>
                                @endif
                                <td class="flex flex-row justify-center items-center gap-2">
                                    <a href="{{route('pedidos.show', $pedido->id)}}">
                                        <img src="icons/general/ojo.png" alt="ver pedido" title="Ver pedido">
                                    </a>
                                    <a href="{{route('pedidos.edit', $pedido->id)}}">
                                        <img src="icons/general/editar.png" alt="editar pedido" title="Editar pedido">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div>
                    {{ $pedidos->links() }}
                </div>
            </section>
        </section>
    </div>
    @include('general.footer')
</body>
</html>