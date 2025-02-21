<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Productos</title>
</head>
<body>
    <form action="{{route('producto.store')}}" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio">
        </div>
        <div>
            <label for="destacado">Producto destacado:</label>
            <input type="checkbox" name="destacado" id="destacado">
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion"></textarea>
        </div>
        <input type="submit" value="Crear">
    </form>
</body>
</html>