<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Administrar | Categorias</title>
</head>
<body>
@include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="w-[85%] p-4">
            <div class="flex flex-row justify-between items-center">
                <h1 class="text-xl font-bold">Categorias</h1>
                <a href="{{route('categoria.create')}}"><button>+ Añadir nueva categoria</button></a>
            </div>
            <div>
                <div>
                    <div>
                        <input type="search" name="buscarCategorias" id="buscarCategorias" placeholder="Buscar categorias..." class="border-2 border-gray p-2">
                    </div>
                    <div>
                        <!-- Filtros -->
                    </div>
                </div>
                <div class="">
                    <table>
                        <tr class="border-2 border-[#131620]">
                            <th class="border-2 border-[#131620]">Código</th>
                            <th class="border-2 border-[#131620]">Nombre</th>
                        </tr>
                    @foreach($categorias as $categoria)
                        <tr class="border-2 border-[#131620]">
                            <td class="border-2 border-[#131620]">{{$categoria->codigo}}</td>
                            <td class="border-2 border-[#131620]">{{$categoria->nombre}}</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
    @include('general.footer')
</body>
</html>