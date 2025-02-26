<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo Producto</title>
</head>
<body>
<form action="{{route('tipoProducto.store')}}" method="POST">
        @csrf
        
        <div>
            <label for="categoria_id">Categoria</label>
            <select name="categoria_id" id="categoria_id">
            @foreach($todasCategorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
            @endforeach
            </select>
        </div>
        <div>
            <label for="codigo">Codigo:</label>
            <input type="text" name="codigo" id="codigo">
        </div>
        <div>
            <label for="foto">Foto:</label>
            <input type="file" name="foto" id="foto" accept="image/*">
        </div>
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="text" name="precio" id="precio">
        </div>
        <div>
            <label for="destacado">Destacado:</label>
            <input type="checkbox" name="destacado" id="destacado" value="1">
        </div>
        <div>
            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion" id="descripcion"></textarea>
        </div>
        <div>
            <label for="estado">Estado:</label>
            <input type="checkbox" name="estado" id="estado" value="1">
        </div>
        <input type="submit" value="Crear">
    </form>
</body>
</html>