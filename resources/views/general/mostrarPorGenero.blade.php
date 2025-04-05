<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    <title>{{$genero}} - SUNDERO Sweatshirt</title>
</head>
<body>
    @include('general.header')
    <section>
        <h1>{{$genero}}</h1>
        <div>
            <div class="flex flex-row flex-wrap">
            @foreach ($productosCategoria as $categoria)
                @foreach ($categoria->tiposProductos as $tipoProducto)
                    <a href="{{route('productos.show', $tipoProducto->id)}}">
                        <div class="w-1/4 shadow-xl rounded-[15px] p-4 hover:bg-slate-300 hover:cursor-pointer">
                            <div class="flex flex-row">
                                <img src="../icons/general/con-capucha.png" alt="imagen producto" class="w-26 h-26">
                            </div>
                            <h2 class="font-bold text-lg">{{$tipoProducto->nombre}}</h2>
                            <span class="text-gray-500">{{$categoria->nombre}}</span>
                            <div class="flex flex-row justify-between">
                                <span class="text-[#0983AC] font-bold">{{$tipoProducto->precio}} €</span>
                                <div class="flex flex-row">
                                    <img src="../icons/general/mas.png" alt="" class="w-[25px] hover:cursor-pointer">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
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