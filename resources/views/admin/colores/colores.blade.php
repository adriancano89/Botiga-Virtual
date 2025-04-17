<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <title>Administrar | Colores</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Colores</h1>
                <a href="{{route('colores.create')}}"><button class="btn-crear fondo-secundario">Añadir nuevo color</button></a>
            </section>
            <section class="contenido">
                <div class="busqueda-filtros">
                    <form action="{{ route('colores.index') }}" method="GET">
                        <div class="buscador">
                            <input type="search" name="busqueda" id="busqueda" placeholder="Buscar colores...">
                            <button type="submit" class="fondo-cuaternario btn-buscar">Buscar</button>
                        </div>
                    </form>
                    <div class="filtros">
                        <form action="{{route('colores.index')}}" method="GET">
                            <div class="filtro">
                                <img src="{{asset('icons/general/ordenar.svg')}}" alt="Ordenar por">
                                <select name="ordenar" id="ordenar">
                                    <option value="" selected>Ordenar por</option>
                                    <option value="nombre">Nombre</option>
                                    <option value="hexadecimal">Código</option>
                                </select>
                            </div>
                            <button type="submit" class="fondo-cuaternario btn-filtrar">Filtrar</button>
                        </form>
                    </div>
                </div>
                <div class="seccion-tabla p-2">
                @if($colores->isEmpty())
                    <span>No se han encontrado resultados.</span>
                @else
                    <table>
                        <tr class="fondo-primario">
                            <th>Nombre</th>
                            <th>Hexadecimal</th>
                            <th>Color</th>
                            <th>Editar</th>
                        </tr>
                    @foreach($colores as $color)
                        <tr>
                            <td>{{$color->nombre}}</td>
                            <td>{{$color->hexadecimal}}</td>
                            <td style="background-color: {{$color->hexadecimal}};"></td>
                            <td>
                                <a href="{{route('colores.edit', $color->id)}}">
                                    <img src="icons/general/editar.png" alt="Editar Color" title="Editar color">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                @endif
                </div>
                <div>
                    {{ $colores->links() }}
                </div>
            </section>
        </section>
    </div>
    @include('general.footer')
</body>
</html>