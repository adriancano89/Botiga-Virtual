<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $table = "cupones";
    
    protected $fillable = ['codigo', 'descuento'];
}
