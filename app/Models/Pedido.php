<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "pedidos";

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id'); // 'usuario_id' es la clave foránea que vincula al usuario
    }
}
