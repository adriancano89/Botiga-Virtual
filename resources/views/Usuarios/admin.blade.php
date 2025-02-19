<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Administrar</title>
</head>
<body>
    @include('General.header')
    <div class="flex flex-row">
        @include('Usuarios.barraLateral')
        <section>
            <div class="flex flex-row">
                <h1>Productos</h1>
                <a href="{{route('producto.create')}}"><button>Añadir nuevo producto</button></a>
            </div>
            <div class="flex flex-column">
                <div class="flex flex-row justify-between">
                    <input type="search" name="" id="">
                    <div>
                        <img src="" alt="">
                        <span>Filtrar</span>
                    </div>
                    <div>
                        <img src="" alt="">
                        <span>Ordenar por</span>
                    </div>
                </div>
                <div>

                </div>
                <div class="flex flex-row">
                    <span>Anterior</span>
                    <button>1</button>
                    <button>2</button>
                    <button>3</button>
                    <span>Siguiente</span>
                </div>
            </div>
        </section>
    </div>
</body>
</html>