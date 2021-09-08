<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
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
        $roles = array_slice(func_get_args(), 2);    //el número indica el numero de parametros 

        //dd($roles);
        //dd(auth()->user()->hasRoles($roles));
            //Solo en caso de que tenga el rol admin, lo dejamos pasar
        if (auth()->user()->hasRoles($roles))
        {
            return $next($request);
        }
        return redirect('/categorias');
    }
}
