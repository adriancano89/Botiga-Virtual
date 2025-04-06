<header class="flex flex-col sm:flex-row items-center justify-between w-full fondo-primario text-white p-4">
    <div class="ml-[10px] mb-4 sm:mb-0">
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

    <div class="flex flex-row gap-5 sm:mr-4 mt-4 sm:mt-0 sm:ml-4">
        <a href="/carrito">
            <img src="{{asset('icons/general/carrito-de-compras.png')}}" alt="carrito" class="icono-header">
        </a>
        <a href="/profile">
            <img src="{{asset('icons/general/usuario.png')}}" alt="perfil" class="icono-header">
        </a>
    </div>
</header>
