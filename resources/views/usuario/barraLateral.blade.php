<nav class="flex flex-col items-start justify-start gap-4 text-[20px] bg-[#131620] text-white p-0  w-[15%]">
    <div class="flex flex-col items-center mx-auto w-[100px]">
        <img src="{{asset('icons/general/perfil_usuario.png')}}" alt="Perfil Usuario" class="w-[100px] mb-1">
        <span>X</span>
    </div>

    <div>
        <div class="hover:cursor-pointer hover:bg-[#4B5563] flex items-center pt-2 pl-7 pr-7 pb-2 w-full">
            <img src="{{asset('icons/general/mis_pedidos.png')}}" alt="Mis Pedidos" class="w-[25px] hover:cursor-pointer">
            <span class="ml-4">Mis Pedidos</span>
        </div>
        <div class="hover:cursor-pointer hover:bg-[#4B5563] flex items-center pt-2 pl-7 pr-7 pb-2 w-full">
            <img src="{{asset('icons/general/historial_compras.png')}}" alt="Historial de Compras" class="w-[25px] hover:cursor-pointer">
            <span class="ml-4">Historial de Compras</span>
        </div>
        <div class="hover:cursor-pointer hover:bg-[#4B5563] flex items-center pt-2 pl-7 pr-7 pb-2 w-full">
            <img src="{{asset('icons/general/informacion-personal.png')}}" alt="Datos Personales" class="w-[25px] hover:cursor-pointer">
            <span class="ml-4">Datos Personales</span>
        </div>
        <div class="hover:cursor-pointer hover:bg-[#4B5563] flex items-center pt-2 pl-7 pr-7 pb-2 w-full">
            <img src="{{asset('icons/general/administracion.png')}}" alt="Administración" class="w-[25px] hover:cursor-pointer">
            <a href="{{route('tiposProductos.index')}}"><span class="ml-4">Administración</span></a>
        </div>
        <div>
            <div class="hover:cursor-pointer hover:bg-[#4B5563] flex items-center pt-2 pl-7 pr-7 pb-2 w-full">
                <img src="{{asset('icons/general/camiseta.png')}}" alt="Productos" class="w-[25px] hover:cursor-pointer ml-7">
                <a href="{{route('tiposProductos.index')}}"><span class="ml-4">Productos</span></a>
            </div>
            <div class="hover:cursor-pointer hover:bg-[#4B5563] flex items-center pt-2 pl-7 pr-7 pb-2 w-full">
                <img src="{{asset('icons/general/ventas.png')}}" alt="Ventas" class="w-[25px] hover:cursor-pointer  ml-7">
                <a href="{{route('pedidos.index')}}"><span class="ml-4">Ventas</span></a>
            </div>
            <div class="hover:cursor-pointer hover:bg-[#4B5563] flex items-center pt-2 pl-7 pr-7 pb-2 w-full">
                <img src="{{asset('icons/general/usuarios.png')}}" alt="Usuarios" class="w-[25px] hover:cursor-pointer  ml-7">
                <a href="{{route('usuarios.index')}}"><span class="ml-4">Usuarios</span></a>
            </div>
            <div class="hover:cursor-pointer hover:bg-[#4B5563] flex items-center pt-2 pl-7 pr-7 pb-2 w-full">
                <img src="{{asset('icons/general/categorias.png')}}" alt="Categorias" class="w-[25px] hover:cursor-pointer  ml-7">
                <a href="{{route('categorias.index')}}"><span class="ml-4">Categorias</span></a>
            </div>
            <div class="hover:cursor-pointer hover:bg-[#4B5563] flex items-center pt-2 pl-7 pr-7 pb-2 w-full">
                <img src="{{asset('icons/general/tallas.png')}}" alt="Tallas" class="w-[25px] hover:cursor-pointer  ml-7">
                <a href="{{route('tallas.index')}}"><span class="ml-4">Tallas</span></a>
            </div>
            <div class="hover:cursor-pointer hover:bg-[#4B5563] flex items-center pt-2 pl-7 pr-7 pb-2 w-full">
                <img src="{{asset('icons/general/paleta-de-color.png')}}" alt="Paleta de Color" class="w-[25px] hover:cursor-pointer  ml-7">
                <a href="{{route('colores.index')}}"><span class="ml-4">Colores</span></a>
            </div>
        </div>
    <div class="bg-[#131620] pt-10 pl-10 pr-10 pb-10">
        <div class="hover:cursor-pointer bg-[#0983AC] border-2 border-[#131620] rounded-[8px] flex items-center pt-4 pl-8 pr-8 pb-4 hover:bg-[#131620] hover:border-2 hover:border-[#0983AC]">
            <img src="{{asset('icons/general/cerrar_sesion.png')}}" alt="Cerrar Sesión" class="w-[25px]">
            <button class="ml-4">Cerrar Sesión</button>
        </div>
    </div>
</nav>