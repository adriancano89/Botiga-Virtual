<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Mostrar por Categorias</title>
</head>
<body>
    @include('general.header')
    <section>
        <h1>Mostrar Productos por categoria: {{ $categoria->nombre }}</h1>

        <div>
            <div class="flex flex-row flex-wrap">
                @foreach ($productosCategoria as $productoCategoria)
                <div class="w-1/4 shadow-xl rounded-[15px] p-4 hover:bg-slate-300 hover:cursor-pointer">
                    <div class="flex flex-row">
                        <img src="../icons/general/con-capucha.png" alt="imagen producto" class="w-26 h-26">
                    </div>
                    <h2 class="font-bold text-lg">{{$productoCategoria->nombre}}</h2>
                    <span class="text-gray-500">{{$productoCategoria->categoria->nombre}}</span>
                    <div class="flex flex-row justify-between">
                        <span class="text-[#0983AC] font-bold">{{$productoCategoria->precio}} €</span>
                        <div class="flex flex-row">
                            <img src="../icons/general/mas.png" alt="" class="w-[25px] hover:cursor-pointer">
                            <span></span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div>
                {{ $productosCategoria->links() }}
            </div>
        </div>
    </section>
    @include('general.footer')
</body>
</html>