<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InShoppingCart extends Model
{
    protected $fillable = ['articulo_id', 'shopping_cart_id','cantidad', 'precio'];
}
