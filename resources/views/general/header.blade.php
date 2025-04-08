<header class="flex flex-col sm:flex-row items-center justify-between w-full fondo-primario text-white p-4">
    <div class="ml-7 mb-4 sm:mb-0">
        <a href="/" class="text-center">
            <h1 class="font-bold text-3xl">SUNDERO</h1>
            <h2 class="text-lg mt-[-5px]">Sweatshirt</h2>
        </a>
    </div>
    
    <nav class="w-full sm:w-auto mb-4 sm:mb-0">
        <ul class="flex flex-row items-center justify-center sm:justify-between gap-4 text-xl">
            <a href="/categorias/genero/hombre">
                <li class="apartado-header">Hombre</li>
            </a>
            <a href="/categorias/genero/mujer">
                <li class="apartado-header">Mujer</li>
            </a>
            <a href="/categorias/genero/niño">
                <li class="apartado-header">Niños</li>
            </a>
        </ul>
    </nav>

    <div class="flex flex-row gap-5 sm:mr-4 mt-4 sm:mt-0 sm:ml-4 relative group">
        <a href="/carrito">
            <img src="{{asset('icons/general/carrito-de-compras.png')}}" alt="carrito" class="icono-header">
        </a>
        <div class="relative">
            <a href="/login" id="iconoPerfil">
                <img src="{{asset('icons/general/usuario.png')}}" alt="perfil" class="icono-header">
            </a>
            @if (session('name'))
            <div id="menuPerfil" class="absolute fondo-primario p-3 rounded shadow-lg right-0 top-7 hidden group-hover:block">
                <a href="/profile" class="block py-2">Mi perfil</a>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="block py-2 w-full text-start">Cerrar sesión</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</header>
