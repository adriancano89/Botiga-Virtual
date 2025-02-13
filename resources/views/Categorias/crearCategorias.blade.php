<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Categorias</title>
</head>
<body>
    <form action="{{route('categoria.store')}}" method="POST">
        @csrf
        <div>
            <label for="codigo">Codigo:</label>
            <input type="text" name="codigo" id="codigo">
        </div>
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <input type="submit" value="Crear">
    </form>
</body>
</html>