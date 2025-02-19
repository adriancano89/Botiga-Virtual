<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "usuarios";

    public function pedidos():HasMany {
        return $this->hasMany(Pedido::class);
    }
}
