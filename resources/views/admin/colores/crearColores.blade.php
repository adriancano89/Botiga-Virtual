<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de colores</title>
</head>
<body>
    <form action="{{route('colores.store')}}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">

        <label for="hexadecimal">Hexadecimal:</label>
        <input type="color" name="hexadecimal" id="hexadecimal">

        <input type="submit" value="Crear">
    </form>
</body>
</html>