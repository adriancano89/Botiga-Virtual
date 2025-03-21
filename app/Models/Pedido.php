<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "pedidos";

    protected $fillable = ['usuario_id', 'precio_total', 'fecha_venta', 'fecha_envio', 'fecha_entrega', 'estado'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id'); // 'usuario_id' es la clave foránea que vincula al usuario
    }
    public function productosPedido(){
        return $this->hasMany(ProductoPedido::class, 'pedidos_id');
    }
}
