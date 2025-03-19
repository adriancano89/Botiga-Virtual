<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoPedido extends Model
{
    protected $table = "productos_pedido";

    protected $fillable = ['pedidos_id', 'productos_id', 'cantidad']; 

    public function pedidos() {
        return $this->belongsToMany(Pedido::class);
    }
    
    public function productos() {
        return $this->belongsToMany(Producto::class);
    }
}
