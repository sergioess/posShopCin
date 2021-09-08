<?php

namespace App\Http\Middleware;

use Closure;
use App\ShoppingCart;

class BuildShoppingCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Los Middleware se ejecutan entre la vista y el controlados, es decier en el medio

        $shopping_cart_id = \Session::get('shopping_cart_id');

        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        $request->shopping_cart = $shopping_cart;

        return $next($request);
    }
}
