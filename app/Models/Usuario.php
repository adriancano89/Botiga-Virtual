<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "usuarios";

    protected $fillable = ['nombre', 'apellidos', 'contrasena', 'email', 'telefono', 'direcion', 'rol'];

    public function pedidos():HasMany {
        return $this->hasMany(Pedido::class);
    }
}
