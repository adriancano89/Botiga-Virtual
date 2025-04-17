<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <title>Administrar | Categorias</title>
</head>
<body>
@include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Categorias</h1>
                <a href="{{route('categorias.create')}}"><button class="btn-crear fondo-secundario">Añadir nueva categoria</button></a>
            </section>
            <section class="contenido">
                <div class="busqueda-filtros">
                    <form action="{{ route('categorias.index') }}" method="GET">
                        <div class="buscador">
                            <input type="search" name="busqueda" id="busqueda" placeholder="Buscar categorias...">
                            <button type="submit" class="fondo-cuaternario btn-buscar">Buscar</button>
                        </div>
                    </form>
                    <div class="filtros">
                        <form action="{{route('categorias.index')}}" method="GET">    
                            <div class="filtro">
                                <img src="{{asset('icons/general/filtrar.svg')}}" alt="Filtrar por">
                                <select name="filtrar" id="filtrar">
                                    <option value="" disabled selected>Filtrar por</option>
                                    <option value="todos">Todas</option>
                                    <option value="Hombre">Hombre</option>
                                    <option value="Mujer">Mujer</option>
                                    <option value="Niño">Niño</option>
                                </select>
                            </div>
                            <div class="filtro">
                                <img src="{{asset('icons/general/ordenar.svg')}}" alt="Ordenar por">
                                <select name="ordenar" id="ordenar">
                                    <option value="" selected>Ordenar por</option>
                                    <option value="codigo">Código</option>
                                    <option value="nombre">Nombre</option>
                                </select>
                            </div>
                            <button type="submit" class="fondo-cuaternario btn-filtrar">Filtrar</button>
                        </form>
                    </div>
                </div>
                <div class="seccion-tabla">
                @if($categorias->isEmpty())
                    <span>No se han encontrado resultados.</span>
                @else
                    <table>
                        <tr class="fondo-primario">
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Editar</th>
                        </tr>
                    @foreach($categorias as $categoria)
                        <tr>
                            <td>{{$categoria->codigo}}</td>
                            <td>{{$categoria->nombre}}</td>
                            <td>
                                <a href="{{route('categorias.edit', $categoria->id)}}">
                                    <img src="icons/general/editar.png" alt="Editar Categoria" title="Editar Categoria">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                @endif
                </div>
                <div>
                    {{ $categorias->links() }}
                </div>
            </section>
        </div>
    </section>
    @include('general.footer')
</body>
</html>