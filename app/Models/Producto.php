<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";

    public function tiposProducto():BelongsToMany {
        return $this->belongsToMany(TipoProducto::class);
    }
    
    public function colores():BelongsToMany {
        return $this->belongsToMany(Color::class);
    }

    public function tallas():BelongsToMany {
        return $this->belongsToMany(Talla::class);
    }
}
