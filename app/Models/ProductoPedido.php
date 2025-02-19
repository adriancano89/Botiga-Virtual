<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoPedido extends Model
{
    protected $table = "productos_pedido";

    public function pedidos():BelongsToMany {
        return $this->belongsToMany(Pedido::class);
    }
    
    public function productos():BelongsToMany {
        return $this->belongsToMany(Producto::class);
    }
}
