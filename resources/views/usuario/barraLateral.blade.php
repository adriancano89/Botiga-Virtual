<nav class="barra-lateral fondo-primario">
    <div class="flex flex-col items-center mx-auto w-[100px]">
        <img src="{{asset('icons/general/perfil_usuario.png')}}" alt="Perfil Usuario" class="w-[100px] mb-1">
        <span>{{ session('name') }}</span>
    </div>

    <ul>
        <a href="{{ route('usuario.misPedidos') }}">
            <li class="apartado">
                <img src="{{asset('icons/general/mis_pedidos.png')}}" alt="Mis Pedidos" class="icono">
                <span>Mis Pedidos</span>
            </li>
        </a>
        <a href="/profile">
            <li class="apartado">
                <img src="{{asset('icons/general/informacion-personal.png')}}" alt="Datos Personales" class="icono">
                <span>Datos Personales</span>
            </li>
        </a>
        <li class="apartado">
            <img src="{{asset('icons/general/administracion.png')}}" alt="Administración" class="icono">
            <a href="{{route('tiposProductos.index')}}"><span>Administración</span></a>
        </li>
        <ul>
            <a href="{{route('tiposProductos.index')}}">
                <li class="apartado">
                    <img src="{{asset('icons/general/camiseta.png')}}" alt="Productos" class="icono ml-7">
                    <span>Productos</span>
                </li>
            </a>
            <a href="{{route('pedidos.index')}}">
                <li class="apartado">
                    <img src="{{asset('icons/general/ventas.png')}}" alt="Ventas" class="icono  ml-7">
                    <span>Ventas</span>
                </li>
            </a>
            <a href="{{route('usuarios.index')}}">
                <li class="apartado">
                    <img src="{{asset('icons/general/usuarios.png')}}" alt="Usuarios" class="icono  ml-7">
                    <span>Usuarios</span>
                </li>
            </a>
            <a href="{{route('categorias.index')}}">
                <li class="apartado">
                    <img src="{{asset('icons/general/categorias.png')}}" alt="Categorias" class="icono  ml-7">
                    <span>Categorias</span>
                </li>
            </a>
            <a href="{{route('tallas.index')}}">
                <li class="apartado">
                    <img src="{{asset('icons/general/tallas.png')}}" alt="Tallas" class="icono  ml-7">
                    <span>Tallas</span>
                </li>
            </a>
            <a href="{{route('colores.index')}}">
                <li class="apartado">
                    <img src="{{asset('icons/general/paleta-de-color.png')}}" alt="Paleta de Color" class="icono  ml-7">
                    <span>Colores</span>
                </li>
            </a>
        </ul>
    </ul>
    <div class="p-4">
        <form action="{{route('logout')}}" method="post">
            @csrf
            <div class="hover:cursor-pointer fondo-secundario border-2 borde-primario rounded-[8px] flex items-center p-4 fondo-primario-hover hover:border-2 borde-secundario-hover">
                <img src="{{asset('icons/general/cerrar_sesion.png')}}" alt="Cerrar Sesión" class="icono">
                <button type="submit">Cerrar Sesión</button>
            </div>
        </form>
    </div>
</nav>