<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categorias</title>
</head>
<body>
    <div class="flex flex-col">
        <div class="flex flex-row justify-between">
            <h1>Editar cCtegoria</h1>
        </div>
        <form action="{{route('categoria.update', $categoria->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-row flex-wrap">
                <div>
                    <label for="codigo">Codigo</label>
                    <input type="text" name="codigo" id="codigo" value="{{$categoria->codigo}}">
                </div>
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{$categoria->nombre}}">
                </div>
            </div>
            <input type="submit" value="Editar">
        </form>
    </div>
</body>
</html>