<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/validaciones.js') }}" defer></script>
    <script src="{{ asset('js/productos/validarForms.js') }}" defer></script>
    <title>Administrar - Crear Tipo Producto</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Crear producto</h1>
            </section>
            <section class="contenido">
                <form action="{{route('tiposProductos.store')}}" method="POST" enctype="multipart/form-data" class="formulario" id="formCrear">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div class="flex flex-col w-full">
                            <label for="codigo" class="label">Código</label>
                            <div class="flex flex-row gap-4">
                                <input type="text" name="codigo" id="codigo" class="input borde-cuaternario w-full" maxlength="7" required>
                                <img src="{{ asset('icons/general/actualizar-flecha.png') }}" alt="Sugerir código" class="w-11 hover:cursor-pointer" title="Sugerir código" id="iconoSugerirCodigo">
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="nombre" class="label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="input borde-cuaternario" required>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="categoria_id" class="label">Categoría</label>
                            <select name="categoria_id" id="categoria_id" class="input borde-cuaternario" required>
                                @foreach($todasCategorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="foto" class="label">Fotografía</label>
                            <input type="file" name="foto" id="foto" accept="image/*" class="input borde-cuaternario">
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="precio" class="label">Precio</label>
                            <input type="number" name="precio" id="precio" class="input borde-cuaternario" step="0.01" min="0" max="200" required>
                        </div>

                        <div class="flex flex-row gap-8 items-center w-full">
                            <label for="destacado" class="label">Destacado</label>
                            <input type="checkbox" name="destacado" id="destacado" value="1" class="checkbox">
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="descripcion" class="label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="input borde-cuaternario w-full h-32" maxlength="255"></textarea>
                        </div>

                        <div class="flex flex-row items-center gap-8 w-full">
                            <label for="estado" class="label">Activo</label>
                            <input type="checkbox" name="estado" id="estado" value="1" class="checkbox" checked>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="imagenes_adicionales" class="label">Imágenes adicionales</label>
                            <input type="file" name="imagenes_adicionales[]" id="imagenes_adicionales" multiple accept="image/*" class="input borde-cuaternario">
                        </div>
                    </div>

                    <div class="flex flex-row justify-center mt-6 w-full">
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