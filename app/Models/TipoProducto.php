<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    protected $table = "tipos_producto";

    protected $fillable = ['categoria_id', 'codigo', 'foto', 'nombre', 'precio', 'destacado', 'descripcion'];
}
