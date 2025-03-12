<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = "carritos";

    protected $fillable = ['usuario_id', 'productos_id', 'cantidad'];


    public function user() {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function producto() {
        return $this->belongsTo(Producto::class, 'productos_id');
    }
}
