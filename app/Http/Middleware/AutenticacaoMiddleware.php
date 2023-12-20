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
        session_start();

        if(isset($_SESSION['email']) && $_SESSION['email'] != '') {
            return $next($request);
        } else {
            // handle if user tries to access a page that requires login
            return redirect()->route('site.login', ['erro' => 2]);
        }

        // echo $auth_method . '<br>' . $user_type . '<br>';
        // // login handler
        // if(true) {
        //     return $next($request);
        // } else {
        //     return Response('Acesso Negado! Rota exige autenticacao');
        // }
    }
}
