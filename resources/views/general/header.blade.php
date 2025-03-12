<header class="flex flex-row items-center justify-between w-full bg-[#131620] text-white p-4">
    <div class="ml-[10px]">
        <a href="/" class="text-center">
            <h1 class="font-bold text-[25px]">SUNDERO</h1>
            <h2 class="text-[15px] mt-[-5px]">Sweatshirt</h2>
        </a>
    </div>
    <nav>
        <ul class="flex flex-row items-center justify-between gap-4 text-[20px]">
            <a href="">
                <li>Hombre</li>
            </a>
            <a href="">
                <li>Mujer</li>
            </a>
            <a href="">
                <li>Niños</li>
            </a>
            <a href="">
                <li class="pl-7 pr-7 pt-1 pb-1 bg-[#F2E984] text-black rounded-[15px] border-2 border-[#131620] hover:text-[#F2E984] hover:border-2 hover:border-[#F2E984] hover:bg-[#131620]">Rebajas</li>
            </a>
        </ul>
    </nav>
    <div class="flex flex-row gap-5 mr-[10px]">
        <img src="{{asset('icons/general/lupa.png')}}" alt="buscar" class="w-[25px] hover:cursor-pointer">
        <a href="/carrito"><img src="{{asset('icons/general/carrito-de-compras.png')}}" alt="carrito" class="w-[25px] hover:cursor-pointer"></a>
        <a href="/profile"><img src="{{asset('icons/general/usuario.png')}}" alt="perfil" class="w-[25px] hover:cursor-pointer"></a>
    </div>
</header>