<header class="flex flex-row items-center justify-between w-full fondo-primario text-white p-4">
    <div class="ml-[10px]">
        <a href="/" class="text-center">
            <h1 class="font-bold text-[25px]">SUNDERO</h1>
            <h2 class="text-[15px] mt-[-5px]">Sweatshirt</h2>
        </a>
    </div>
    <nav>
        <ul class="flex flex-row items-center justify-between gap-4 text-[20px]">
            <a href="/categorias/genero/hombre">
                <li>Hombre</li>
            </a>
            <a href="/categorias/genero/mujer">
                <li>Mujer</li>
            </a>
            <a href="/categorias/genero/niño">
                <li>Niños</li>
            </a>
        </ul>
    </nav>
    <div class="flex flex-row gap-5 mr-[10px]">
        <img src="{{asset('icons/general/lupa.png')}}" alt="buscar">
        <a href="/carrito"><img src="{{asset('icons/general/carrito-de-compras.png')}}" alt="carrito"></a>
        <a href="/profile"><img src="{{asset('icons/general/usuario.png')}}" alt="perfil"></a>
    </div>
</header>