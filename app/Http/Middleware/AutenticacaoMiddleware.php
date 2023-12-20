<?php

namespace App\Http\Middleware;

use Closure;
use Facade\FlareClient\Http\Response;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $auth_method, $user_type)
    {
        echo $auth_method . '<br>' . $user_type . '<br>';
        // login handler
        if(true) {
            return $next($request);
        } else {
            return Response('Acesso Negado! Rota exige autenticacao');
        }

    }
}
