<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Administrar | Ventas</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="w-[85%] p-4">
            <div class="flex flex-row justify-between items-center">
                <h1 class="text-xl font-bold">Ventas</h1>
            </div>
            <div>
                <div>
                    <div>
                        <input type="search" name="buscarVentas" id="buscarVentas" placeholder="Buscar ventas..." class="border-2 border-gray p-2">
                    </div>
                    <div>
                        <!-- Filtros -->
                    </div>
                </div>
                <div class="">
                    <table>
                        <tr class="border-2 border-[#131620]">
                            <th class="border-2 border-[#131620]">Usuario</th>
                            <th class="border-2 border-[#131620]">Precio total</th>
                            <th class="border-2 border-[#131620]">Fecha venta</th>
                            <th class="border-2 border-[#131620]">Fecha envío</th>
                            <th class="border-2 border-[#131620]">Fecha entrega</th>
                            <th class="border-2 border-[#131620]">Estado</th>
                            <th class="border-2 border-[#131620]">Acciones</th>
                        </tr>
                        @foreach($pedidos as $pedido)
                            <tr class="border-2 border-[#131620]">
                                <td class="border-2 border-[#131620]">{{$pedido->usuario->email}}</td>
                                <td class="border-2 border-[#131620]">{{$pedido->precio_total}}</td>
                                <td class="border-2 border-[#131620]">{{$pedido->fecha_venta}}</td>
                                <td class="border-2 border-[#131620]">{{$pedido->fecha_envio ? $pedido->fecha_envio : 'Sin determinar'}}</td>
                                <td class="border-2 border-[#131620]">{{$pedido->fecha_entrega ? $pedido->fecha_entrega : 'Sin determinar'}}</td>
                                @if ($pedido->estado)
                                    <td class="border-2 border-[#131620] bg-[#C9C9C9]">Finalizado</td>
                                @else
                                    <td class="border-2 border-[#131620] bg-[#DCFCE7]">Pendiente</td>
                                @endif
                                <td class="border-2 border-[#131620] flex flex-row justify-center items-center gap-2">
                                    <a href="{{route('pedidos.show', $pedido->id)}}" class="flex flex-row justify-center hover:cursor-pointer">
                                        <img src="icons/general/ojo.png" alt="editar pedido" class="w-8 h-8 mt-2" title="Ver pedido">
                                    </a>
                                    <a href="{{route('pedidos.edit', $pedido->id)}}" class="flex flex-row justify-center hover:cursor-pointer">
                                        <img src="icons/general/editar.png" alt="editar pedido" class="w-8 h-8 mt-2" title="Editar pedido">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
    @include('general.footer')
</body>
</html>