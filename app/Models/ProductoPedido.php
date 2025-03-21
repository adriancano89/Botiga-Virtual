<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoPedido extends Model
{
    protected $table = "productos_pedido";

    protected $fillable = ['pedidos_id', 'productos_id', 'cantidad']; 

    public function pedido() {
        return $this->belongsTo(Pedido::class, 'pedidos_id');
    }
    
    public function producto() {
        return $this->belongsTo(Producto::class, 'productos_id');
    }
}
