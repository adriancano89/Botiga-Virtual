<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Sundero Sweatshirt</title>
</head>
<body>
    @include('general.header')
    <section class="flex flex-col justify-center items-center">
        <div class="relative inline-block text-left mt-4 mb-4">
            <div class="absolute top-1/2 left-[15%] transform -translate-x-1/2 -translate-y-1/2 w-1/4 text-white">
                <h2 class="font-bold text-4xl ">Categoria invierno 2025</h2>
                <p class="mt-4 mb-8">Descubre nuestras sudaderas premium diseñadas para ofrecer estilo y comodidad.</p>
                <a href="" class="text-black font-bold bg-[#F2E984] rounded-3xl p-[12px]"><button>Compra ahora!</button></a>
            </div>
            <img src="{{asset('icons/general/imagen-pagina-principal.svg')}}" alt="imagen" class="rounded-3xl">
        </div>

        <div>
            <h1>Destacado</h1>
            <div class="flex flex-row justify-between">
                <div>
                    <input type="search" name="buscarProductos" id="buscarProductos" placeholder="Buscar productos..." class="border-2 border-gray p-2">
                </div>

                <div class="flex flex-row justify-between">
                    <div>
                        <label for="talla">Talla</label>
                        <select name="talla" id="talla"></select>
                    </div>
                    <div>
                        <label for="talla">Color</label>
                        <select name="color" id="color"></select>
                    </div>
                    <div>
                        <label for="talla">Filtrar por</label>
                        <select name="filtrarPor" id="filtrarPor"></select>
                    </div>
                </div>
            </div>
            <div>
                <div class="flex flex-row flex-wrap">
                    @foreach ($productos as $producto)
                    <div class="w-1/4 shadow-xl rounded-[15px] p-4 hover:bg-slate-300 hover:cursor-pointer">
                        <div class="flex flex-row">
                            <img src="icons/general/con-capucha.png" alt="imagen producto" class="w-26 h-26">
                        </div>
                        <h2 class="font-bold text-lg">{{$producto->nombre}}</h2>
                        <span class="text-gray-500">{{$producto->categoria->nombre}}</span>
                        <div class="flex flex-row justify-between">
                            <span class="text-[#0983AC] font-bold">{{$producto->precio}} €</span>
                            <div class="flex flex-row">
                                <img src="icons/general/mas.png" alt="" class="w-[25px] hover:cursor-pointer">
                                <span></span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div>
                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    </section>
    @include('general.footer')
</body>
</html>