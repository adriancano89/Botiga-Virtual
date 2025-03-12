<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";

    protected $fillable = ['tipos_producto_id', 'talla_id', 'color_id', 'stock']; 

    public function tipoProducto() {
        return $this->belongsTo(TipoProducto::class, 'tipos_producto_id');
    }

    public function talla() {
        return $this->belongsTo(Talla::class, 'talla_id');
    }

    public function color() {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function carrito() {
        return $this->hasMany(Carrito::class, 'productos_id');
    }
}
