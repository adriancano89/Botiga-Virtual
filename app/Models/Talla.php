<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $table = "tallas";
    protected $fillable = ['nombre'];

    public function productos() {
        return $this->hasMany(Producto::class, 'talla_id');
    }
}
