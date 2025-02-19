<nav>
    <div>
        <img src="{{asset('icons/general/usuario.png')}}" alt="icono perfil">
        <span></span>
    </div>

    <div>
        <div>
            <img src="" alt="">
            <span>Mis pedidos</span>
        </div>
        <div>
            <img src="" alt="">
            <span>Historial compras</span>
        </div>
        <div>
            <img src="" alt="">
            <a href="{{route('usuario.admin')}}"><span>Administración</span></a>

            <div>
                <img src="" alt="">
                <a href="{{route('producto.index')}}"><span>Productos</span></a>
            </div>
            <div>
                <img src="" alt="">
                <a href="{{route('pedido.index')}}"><span>Ventas</span></a>
            </div>
            <div>
                <img src="" alt="">
                <a href="{{route('usuario.index')}}"><span>Usuarios</span></a>
            </div>
        </div>
        <div>
            <img src="" alt="">
            <div>
                <span></span>
                <span></span>
            </div>
        </div>
    <div>
        <button>Cerrar sesión</button>
    </div>
</nav>