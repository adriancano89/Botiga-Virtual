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
                    <div class="buscador">
                        <input type="search" name="buscarColores" id="buscarColores" placeholder="Buscar colores...">
                    </div>
                    <div class="filtros">
                        <div class="filtro">
                            <img src="{{asset('icons/general/filtrar.svg')}}" alt="Filtrar por">
                            <select name="filtrar" id="filtrar">
                                <option value="" disabled selected>Filtrar por</option>
                                <option value="nombre">Nombre</option>
                                <option value="hexadecimal">Hexadecimal</option>
                            </select>
                        </div>
                        <div class="filtro">
                            <img src="{{asset('icons/general/ordenar.svg')}}" alt="Ordenar por">
                            <select name="ordenar" id="ordenar">
                                <option value="" disabled selected>Ordenar por</option>
                                <option value="nombre">Nombre</option>
                                <option value="hexadecimal">Hexadecimal</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="seccion-tabla p-2">
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
                </div>
            </section>
        </section>
    </div>
    @include('general.footer')
</body>
</html>