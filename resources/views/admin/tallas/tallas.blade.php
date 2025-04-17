<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <title>Administrar | Tallas</title>
</head>
<body>
@include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido ml-[20%] mr-[20%]">
                <h1>Tallas</h1>
                <a href="{{route('tallas.create')}}"><button class="btn-crear fondo-secundario">Añadir nueva talla</button></a>
            </section>
            <section class="contenido">
                <div class="busqueda-filtros">
                    <form action="{{ route('tallas.index') }}" method="GET">
                        <div class="buscador">
                            <input type="search" name="busqueda" id="busqueda" placeholder="Buscar tallas...">
                            <button type="submit" class="fondo-cuaternario btn-buscar">Buscar</button>
                        </div>
                    </form>
                    <div class="filtros">
                        <form action="{{route('tallas.index')}}" method="GET">    
                            <div class="filtro">
                                <img src="{{asset('icons/general/ordenar.svg')}}" alt="Ordenar por">
                                <select name="ordenar" id="ordenar">
                                    <option value="" selected>Ordenar por</option>
                                    <option value="nombre">Nombre</option>
                                </select>
                            </div>
                            <button type="submit" class="fondo-cuaternario btn-filtrar">Filtrar</button>
                        </form>
                    </div>
                </div>
                <div class="seccion-tabla items-center">
                @if($tallas->isEmpty())
                    <span>No se han encontrado resultados.</span>
                @else
                    <table class="w-3/5">
                        <tr class="fondo-primario">
                            <th>Nombre</th>
                            <th>Editar</th>
                        </tr>
                    @foreach($tallas as $talla)
                        <tr>
                            <td>{{$talla->nombre}}</td>
                            <td>
                                <a href="{{route('tallas.edit', $talla->id)}}">
                                    <img src="{{asset('icons/general/editar.png')}}" alt="editar talla">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                @endif
                </div>
                <div>
                    {{ $tallas->links() }}
                </div>
            </section>
        </section>
    </div>
    @include('general.footer')
</body>
</html>