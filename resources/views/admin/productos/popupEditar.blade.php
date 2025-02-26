<div class="flex flex-col">
    <div class="flex flex-row justify-between">
        <h1>Editar producto</h1>
    </div>
    <form action="{{route('tipoProducto.update', $producto->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="flex flex-row flex-wrap">
            <div>
                <label for="codigo">Código</label>
                <input type="text" name="codigo" id="codigo" value="{{$producto->codigo}}">
            </div>
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{$producto->nombre}}">
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
                <input type="text" name="precio" id="precio" value="{{$producto->precio}}">
            </div>
            <div>
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion">{{$producto->descripcion}}</textarea>
            </div>
            <div>
                <label for="destacado">Destacado:</label>
                @if ($producto->destacado)
                    <input type="checkbox" name="destacado" id="destacado" checked value="1">
                @else
                    <input type="checkbox" name="destacado" id="destacado" value="1">
                @endif
            </div>
        </div>
        <input type="submit" value="Editar">
    </form>
    
</div>