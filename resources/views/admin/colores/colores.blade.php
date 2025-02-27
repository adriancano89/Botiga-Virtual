<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Administrar | Colores</title>
</head>
<body>
@include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="w-[85%] p-4">
            <div class="flex flex-row justify-between items-center">
                <h1 class="text-xl font-bold">Colores</h1>
                <a href="{{route('colores.create')}}"><button>+ Añadir nuevo color</button></a>
            </div>
            <div>
                <div>
                    <div>
                        <input type="search" name="buscarColores" id="buscarColores" placeholder="Buscar colores..." class="border-2 border-gray p-2">
                    </div>
                    <div>
                        <!-- Filtros -->
                    </div>
                </div>
                <div class="">
                    <table>
                        <tr class="border-2 border-[#131620]">
                            <th class="border-2 border-[#131620]">Nombre</th>
                            <th class="border-2 border-[#131620]">Hexadecimal</th>
                            <th class="border-2 border-[#131620]">Color</th>
                            <th class="border-2 border-[#131620]">Editar</th>
                        </tr>
                    @foreach($colores as $color)
                        <tr class="border-2 border-[#131620]">
                            <td class="border-2 border-[#131620]">{{$color->nombre}}</td>
                            <td class="border-2 border-[#131620]">{{$color->hexadecimal}}</td>
                            <td class="border-2 border-[#131620]" style="background-color: {{$color->hexadecimal}};"></td>
                            <td class="border-2 border-[#131620]"><a href="{{route('colores.edit', $color->id)}}" class="flex flex-row justify-center"><img src="icons/general/editar.png" alt="Editar Color" class="w-8 h-8 mt-2" title="Editar color"></a></td>
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