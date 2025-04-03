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
                <div class="busqueda-filtros ml-[20%] mr-[20%]">
                    <div class="buscador">
                        <input type="search" name="buscarTallas" id="buscarTallas" placeholder="Buscar talla...">
                    </div>
                    <div class="filtros">
                        <div class="filtro">
                            <img src="{{asset('icons/general/filtrar.svg')}}" alt="Filtrar por">
                            <select name="filtrar" id="filtrar">
                                <option value="" disabled selected>Filtrar por</option>
                                <option value="nombre">Nombre</option>
                            </select>
                        </div>
                        <div class="filtro">
                            <img src="{{asset('icons/general/ordenar.svg')}}" alt="Ordenar por">
                            <select name="ordenar" id="ordenar">
                                <option value="" disabled selected>Ordenar por</option>
                                <option value="nombre">Nombre</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="seccion-tabla items-center">
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