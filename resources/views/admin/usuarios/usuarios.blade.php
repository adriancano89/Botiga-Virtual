<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/usuarios/Usuario.js') }}" defer></script>
    <script src="{{ asset('js/usuarios/editarUsuario.js') }}" defer></script>
    <title>Administrar | Usuarios</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="w-[85%] p-4">
            <div class="flex flex-row justify-between items-center">
                <h1 class="text-xl font-bold">Usuarios</h1>
                <a href="{{route('usuarios.create')}}"><button>+ Añadir nuevo usuario</button></a>
            </div>
            <div>
                <div>
                    <div>
                        <input type="search" name="buscarProductos" id="buscarProductos" placeholder="Buscar productos..." class="border-2 border-gray p-2">
                    </div>
                    <div>
                        <!-- Filtros -->
                    </div>
                </div>
                <div class="">
                    <table>
                        <tr class="border-2 border-[#131620]">
                            <th class="border-2 border-[#131620]">Nombre</th>
                            <th class="border-2 border-[#131620]">Apellidos</th>
                            <th class="border-2 border-[#131620]">Email</th>
                            <th class="border-2 border-[#131620]">Teléfono</th>
                            <th class="border-2 border-[#131620]">Rol</th>
                        </tr>
                        @foreach($todosUsuarios as $usuario)
                            <tr class="border-2 border-[#131620]">
                                <td class="border-2 border-[#131620]">{{$usuario->name}}</td>
                                <td class="border-2 border-[#131620]">{{$usuario->apellidos}}</td>
                                <td class="border-2 border-[#131620]">{{$usuario->email}}</td>
                                <td class="border-2 border-[#131620]">{{$usuario->telefono}}</td>
                                <td class="border-2 border-[#131620]">
                                    <select name="rol" id="{{ $usuario->id }}" class="rol">
                                        <option value="0" {{ !$usuario->rol ? 'selected' : '' }}>Cliente</option>
                                        <option value="1" {{ $usuario->rol ? 'selected' : '' }}>Administrador</option>
                                    </select>
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