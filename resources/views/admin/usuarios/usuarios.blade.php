<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar | Usuarios</title>
</head>
<body>
    @include('General.header')
    <div class="flex flex-row">
        @include('Usuarios.barraLateral')
        <div class="w-[85%] p-4">
        <!-- 
            <div class="flex flex-row justify-between items-center">
                <h1 class="text-xl font-bold">Productos</h1>
                <a href="{{route('tipoProducto.create')}}"><button>Añadir nuevo producto</button></a>
            </div>
            <div>
                <div>
                    <div>
                        <input type="search" name="buscarProductos" id="buscarProductos" placeholder="Buscar productos..." class="border-2 border-gray p-2">
                    </div>
                    <div>

                    </div>
                </div>
                <div class="flex flex-row flex-wrap gap-2">
                    @foreach($productos as $producto)
                        <div>
                            <div class="flex flex-row">
                                <img src="{{asset('icons/general/editar.png')}}" alt="editar producto" class="w-[25px] hover:cursor-pointer">
                                <img src="{{asset('icons/general/papelera.png')}}" alt="eliminar producto" class="w-[25px] hover:cursor-pointer">
                            </div>
                            <h2>{{$producto->nombre}}</h2>
                            <span>{{$producto->codigo}}</span>
                            <div>
                                <span>{{$producto->precio}}</span>
                                <span></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>-->
        </div>
    </div>
    @include('General.footer')
</body>
</html>