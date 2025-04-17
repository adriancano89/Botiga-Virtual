<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/usuarios/Usuario.js') }}" defer></script>
    <script src="{{ asset('js/usuarios/editarUsuario.js') }}" defer></script>
    <title>Administrar | Usuarios</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Usuarios</h1>
                <a href="{{route('usuarios.create')}}"><button class="btn-crear fondo-secundario">Crear nuevo usuario</button></a>
            </section>
            <section class="contenido">
                <div class="busqueda-filtros">
                    <form action="{{ route('usuarios.index') }}" method="GET">
                        <div class="buscador">
                            <input type="search" name="busqueda" id="busqueda" placeholder="Buscar usuarios...">
                            <button type="submit" class="fondo-cuaternario btn-buscar">Buscar</button>
                        </div>
                    </form>

                    <div class="filtros">
                        <form action="{{route('usuarios.index')}}" method="GET">    
                            <div class="filtro">
                                <img src="{{asset('icons/general/filtrar.svg')}}" alt="Filtrar por">
                                <select name="filtrar" id="filtrar">
                                    <option value="" disabled selected>Filtrar por</option>
                                    <option value="todos">Todos</option>
                                    <option value="clientes">Clientes</option>
                                    <option value="administradores">Administradores</option>
                                </select>
                            </div>
                            <div class="filtro">
                                <img src="{{asset('icons/general/ordenar.svg')}}" alt="Ordenar por">
                                <select name="ordenar" id="ordenar">
                                    <option value="" selected>Ordenar por</option>
                                    <option value="name">Nombre</option>
                                    <option value="apellidos">Apellidos</option>
                                    <option value="email">Email</option>
                                    <option value="telefono">Teléfono</option>
                                </select>
                            </div>
                            <button type="submit" class="fondo-cuaternario btn-filtrar">Filtrar</button>
                        </form>
                    </div>
                </div>
                <div class="seccion-tabla">
                @if($todosUsuarios->isEmpty())
                    <span>No se han encontrado resultados.</span>
                @else
                    <table>
                        <tr class="fondo-primario">
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                        </tr>
                        @foreach($todosUsuarios as $usuario)
                            <tr>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->apellidos}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>{{$usuario->telefono}}</td>
                                <td>
                                    <select name="rol" id="{{ $usuario->id }}" class="rol">
                                        <option value="0" {{ !$usuario->rol ? 'selected' : '' }}>Cliente</option>
                                        <option value="1" {{ $usuario->rol ? 'selected' : '' }}>Administrador</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
                </div>
                <div>
                    {{ $todosUsuarios->links() }}
                </div>
            </section>
        </section>
    </div>
    @include('general.footer')
</body>
</html>