<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    protected $table = "tipos_producto";

    protected $fillable = ['categoria_id', 'codigo', 'foto', 'nombre', 'precio', 'destacado', 'descripcion', 'estado'];

    public function fotos() {
        return $this->hasMany(Foto::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function productos() {
        return $this->hasMany(Producto::class, 'tipos_producto_id');
    }
}
