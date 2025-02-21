<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
</head>
<body>
    <form action="{{route('usuario.store')}}" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <div>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos">
        </div>
        <div>
            <label for="contrasena">Coñtrasena:</label>
            <input type="text" name="contrasena" id="contrasena">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email">
        </div>
        <div>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono">
        </div>
        <div>
            <label for="direcion">Direción:</label>
            <input type="text" name="direcion" id="direcion">
        </div>
        <div>
            <label for="rol">Rol:</label>
            <select name="rol" id="rol">
                <option value="" disabled selected>--Selecionar--</option>
                <option value="0">Cliente</option>
                <option value="1">Administrador</option>
            </select>
        </div>
        <input type="submit" value="Crear">
    </form>
</body>
</html>