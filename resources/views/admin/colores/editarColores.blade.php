<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Colores</title>
</head>
<body>
    <div class="flex flex-col">
        <div class="flex flex-row justify-between">
            <h1>Editar Color</h1>
        </div>
        <form action="{{route('color.update', $color->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-row flex-wrap">
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{$color->nombre}}">
                </div>
                <div>
                    <label for="hexadecimal">Hexadecimal</label>
                    <input type="color" name="hexadecimal" id="hexadecimal" value="{{$color->hexadecimal}}">
                </div>
            </div>
            <input type="submit" value="Editar">
        </form>
    </div>
</body>
</html>