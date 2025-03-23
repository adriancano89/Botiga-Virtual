<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/productos/eliminarImagenesAdicionales.js') }}" defer></script>
    <title>Editar prodcuto</title>
</head>
<body>
    <div class="flex flex-col">
        <div class="flex flex-row justify-between">
            <h1>Editar producto</h1>
        </div>
        <form action="{{route('tiposProductos.update', $producto->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col flex-wrap">
                <div>
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" id="codigo" value="{{$producto->codigo}}" class="border border-black">
                </div>
                <div>
                    <label for="foto">Foto:</label>
                    @if($producto->foto)
                        <img src="{{ asset('storage/' . $producto->foto) }}" alt="Imagen del producto">
                    @else
                        <p>No hay imagen disponible</p>
                    @endif
                    <input type="file" name="foto" id="foto" accept="image/*">
                </div>
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{$producto->nombre}}" class="border border-black">
                </div>
                <div>
                    <label for="categoria">Categoria</label>
                    <select name="categoria_id" id="categoria_id">
                    @foreach($categorias as $categoria)
                        @if ($categoria->id == $producto->categoria_id)
                            <option value="{{$categoria->id}}" selected>{{$categoria->nombre}}</option>
                        @else
                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                        @endif
                    @endforeach
                    </select>
                </div>
                <div>
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" id="precio" value="{{$producto->precio}}" class="border border-black">
                </div>
                <div>
                    <label for="destacado">Destacado:</label>
                    @if ($producto->destacado)
                        <input type="checkbox" name="destacado" id="destacado" checked value="1">
                    @else
                        <input type="checkbox" name="destacado" id="destacado" value="1">
                    @endif
                </div>
                <div>
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="border border-black">{{$producto->descripcion}}</textarea>
                </div>
                <div>
                    <label for="estado">Estado:</label>
                    @if ($producto->estado)
                        <input type="checkbox" name="estado" id="estado" checked value="1">
                    @else
                        <input type="checkbox" name="estado" id="estado" value="1">
                    @endif
                </div>
                <div>
                    <span>Imágenes adicionales:</span>
                    <div class="flex flex-row">
                    @foreach ($imagenes as $imagen)
                        <div class="flex flex-row">
                            <img src="{{ asset('storage/' . $imagen->url) }}" alt="Imagen del producto" class="w-28 hover:cursor-pointer">
                            <img src="{{asset('icons/general/papelera.png')}}" alt="eliminar imagen adicional del producto" class="w-8 h-8 hover:cursor-pointer icono-eliminar" id="{{$imagen->id}}" title="Eliminar imagen adicional">
                        </div>
                    @endforeach
                    </div>
                    <input type="file" name="imagenes_adicionales[]" id="imagenes_adicionales" multiple accept="image/*">
                </div>
            </div>
            <input type="submit" value="Editar">
        </form>
    </div>
</body>
</html>