<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <script src="{{ asset('js/validaciones.js') }}" defer></script>
    <script src="{{ asset('js/usuarios/validarForms.js') }}" defer></script>
    <title>Administrar - Crear Usuario</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Crear usuario</h1>
            </section>
            <section class="contenido">
                <form action="{{route('usuarios.store')}}" method="POST" class="formulario" id="formulario">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="flex flex-col">
                            <label for="nombre" class="label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="input borde-cuaternario" required>
                        </div>

                        <div class="flex flex-col">
                            <label for="apellidos" class="label">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="input borde-cuaternario">
                        </div>

                        <div class="flex flex-col">
                            <label for="contrasena" class="label">Contraseña</label>
                            <input type="password" name="contrasena" id="contrasena" class="input borde-cuaternario" required>
                        </div>

                        <div class="flex flex-col">
                            <label for="email" class="label">Email</label>
                            <input type="email" name="email" id="email" class="input borde-cuaternario" required>
                        </div>

                        <div class="flex flex-col">
                            <label for="telefono" class="label">Teléfono</label>
                            <input type="tel" name="telefono" id="telefono" class="input borde-cuaternario" required>
                        </div>

                        <div class="flex flex-col">
                            <label for="direcion" class="label">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="input borde-cuaternario" required>
                        </div>

                        <div class="flex flex-col">
                            <label for="rol" class="label">Rol</label>
                            <select name="rol" id="rol" class="input borde-cuaternario" required>
                                <option value="" disabled selected>--Seleccionar--</option>
                                <option value="0">Cliente</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-row justify-center mt-6">
                        <button type="submit" class="btn-enviar fondo-secundario">Crear</button>
                    </div>
                </form>
            </section>
        </section>
    </div>
    @include('popups.popupErroresFormulario')
    @include('general.footer')
</body>
</html>