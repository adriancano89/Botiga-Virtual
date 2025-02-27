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
                <a href="{{route('categorias.create')}}"><button>+ Añadir nueva categoria</button></a>
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
                            <th class="border-2 border-[#131620]">Editar</th>
                        </tr>
                    @foreach($categorias as $categoria)
                        <tr class="border-2 border-[#131620]">
                            <td class="border-2 border-[#131620]">{{$categoria->codigo}}</td>
                            <td class="border-2 border-[#131620]">{{$categoria->nombre}}</td>
                            <td class="border-2 border-[#131620]"><a href="{{route('categorias.edit', $categoria->id)}}" class="flex flex-row justify-center"><img src="icons/general/editar.png" alt="Editar Categoria" class="w-8 h-8 mt-2" title="Editar Categoria"></a></td>
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