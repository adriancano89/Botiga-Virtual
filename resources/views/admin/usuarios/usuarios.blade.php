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
                    <div class="buscador">
                        <input type="search" name="buscarProductos" id="buscarProductos" placeholder="Buscar productos...">
                    </div>
                    <div class="filtros">
                        <div class="filtro">
                            <img src="{{asset('icons/general/filtrar.svg')}}" alt="Filtrar por">
                            <select name="filtrar" id="filtrar">
                                <option value="" disabled selected>Filtrar por</option>
                                <option value="todos">Todos</option>
                                <option value="rol">Rol</option>
                            </select>
                        </div>
                        <div class="filtro">
                            <img src="{{asset('icons/general/ordenar.svg')}}" alt="Ordenar por">
                            <select name="ordenar" id="ordenar">
                                <option value="" disabled selected>Ordenar por</option>
                                <option value="precio">Nombre</option>
                                <option value="">Apellidos</option>
                                <option value="inactivo">Email</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="seccion-tabla">
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