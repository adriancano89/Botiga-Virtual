<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Administrar | Tallas</title>
</head>
<body>
@include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="w-[85%] p-4">
            <div class="flex flex-row justify-between items-center">
                <h1 class="text-xl font-bold">Tallas</h1>
                <a href="{{route('tallas.create')}}"><button>+ Añadir nueva talla</button></a>
            </div>
            <div>
                <div>
                    <div>
                        <input type="search" name="buscarTallas" id="buscarTallas" placeholder="Buscar talla..." class="border-2 border-gray p-2">
                    </div>
                    <div>
                        <!-- Filtros -->
                    </div>
                </div>
                <div class="">
                    <table>
                        <tr class="border-2 border-[#131620]">
                            <th class="border-2 border-[#131620] text-center">Nombre</th>
                            <th class="border-2 border-[#131620] text-center">Editar</th>
                        </tr>
                    @foreach($tallas as $talla)
                        <tr class="border-2 border-[#131620]">
                            <td class="border-2 border-[#131620] text-center">{{$talla->nombre}}</td>
                            <td class="border-2 border-[#131620]">
                                <a href="{{route('tallas.edit', $talla->id)}}" class="flex flex-row justify-center">
                                    <img src="{{asset('icons/general/editar.png')}}" alt="editar talla" class="w-[25px] hover:cursor-pointer">
                                </a>
                            </td>
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