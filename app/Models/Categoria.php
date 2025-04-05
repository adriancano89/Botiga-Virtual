<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "categorias";

    protected $fillable = ['codigo', 'nombre'];

    public function tiposProductos(){
        return $this->hasMany(TipoProducto::class, 'categoria_id');
    }
}
