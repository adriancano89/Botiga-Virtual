<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = "colores";
    
    protected $fillable = ['nombre', 'hexadecimal'];

    public function productos() {
        return $this->hasMany(Producto::class, 'color_id');
    }
}
