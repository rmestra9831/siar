<?php

namespace App\Http\Middleware;

use App\Models\Radicado;
use Closure;

class CanViewRadic
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
        if (auth()->user()->hasrole('Admisiones')) {
            return $next($request);
        }else{
            $radicado = Radicado::where('slug',$request->route()->parameter('slug'))->firstOrFail();
            if (auth()->user()->hasrole('Jef Programa|Aux Direcion|Secretaria de Direccion')) {
                if ($radicado->delegate_id == auth()->user()->id && $request->route()->parameter('slug') == $radicado->slug) {
                    return $next($request);
                }else{
                    return abort(403);
                }
            }else{
                if (auth()->user()->hasrole('Direccion')) {
                    if ($radicado->date_sent_dir && $request->route()->parameter('slug') == $radicado->slug) {
                        return $next($request);
                    }else{
                        return abort(403);
                    }
                }
            }
        }
    }
}
