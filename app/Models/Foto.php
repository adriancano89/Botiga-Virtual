<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = "fotos";

    protected $fillable = ['tipos_producto_id', 'url'];
}
