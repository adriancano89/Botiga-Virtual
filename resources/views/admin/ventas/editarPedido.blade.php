<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css', 'resources/css/editarVentas.css'])
    <title>Administrar | Editar pedido</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Editar pedido</h1>
            </section>
            <section class="contenido w-[80%] m-auto">
                <form action="{{route('pedidos.update', $pedido->id)}}" method="post" class="flex flex-col mt-2">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-row mb-2">
                        <div class="campo">
                            <span class="titulo-campo fondo-primario rounded-l-md">Dirección entrega</span>
                            <span class="w-full text-center p-3">{{$pedido->usuario->direccion}}</span>
                        </div>
                        <div class="campo">
                            <span  class="titulo-campo fondo-primario">Precio total</span>
                            <span class="p-3">{{$pedido->precio_total}} €</span>
                        </div>
                        <div class="campo">
                            <span class="titulo-campo fondo-primario rounded-r-md">Fecha venta</span>
                            <span class="p-3">{{$pedido->fecha_venta}}</span>
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <div class="campo">
                            <span class="titulo-campo fondo-primario rounded-l-md">Fecha envío</span>
                            <input type="date" name="fecha_envio" id="fecha_envio" value="{{$pedido->fecha_envio}}" class="p-2">
                        </div>
                        <div class="campo">
                            <span class="titulo-campo fondo-primario">Fecha entrega</span>
                            <input type="date" name="fecha_entrega" id="fecha_entrega" value="{{$pedido->fecha_entrega}}" class="p-2">
                        </div>
                        <div class="campo">
                            <span class="titulo-campo fondo-primario rounded-r-md">Estado</span>
                            <select name="estado" id="estado" class="rounded-lg text-center p-2">
                                <option value="0" {{$pedido->estado ? 'selected' : ''}}>Pendiente</option>
                                <option value="1" {{$pedido->estado ? 'selected' : ''}}>Finalizado</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-row justify-between mt-4">
                        <a href="{{route('pedidos.edit', $pedido->id)}}"><button type="button" class="fondo-cuaternario text-white p-3 rounded-md">Descartar cambios</button></a>
                        <button type="submit" class="fondo-secundario text-white p-3 rounded-md">Guardar cambios</button>
                    </div>
                </form>
            </section>
        </section>
    </div>
    @include('general.footer')
</body>
</html>