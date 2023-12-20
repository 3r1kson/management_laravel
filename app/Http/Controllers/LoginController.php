<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    //
    public function index(Request $request) {
        $erro = '';
        
        if($request->get('erro') == 1) {
            $erro = 'Usuario ou senha invalidos';
        };

        if($request->get('erro') == 2) {
            $erro = 'Necessario realizar login para ter acesso a pagina';
        };

        return view('site.login', ['titulo' => 'login', 'erro' => $erro]);
    }

    public function authentication(Request $request) {

        //validation rules
        $rules = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        // feedback validation messages
        $feedback = [
            'usuario.email' => 'O campo usuario (email) e obrigatorio',
            'senha.required' => 'O campo senha e obrigatorio'
        ];

        $request->validate($rules, $feedback);


        $email = $request->get('usuario');
        $password = $request->get('senha');

        // start Model User
        $user = new User;

        $hasUser = $user->where('email', $email)->where('password', $password)->get()->first();

        if(isset($hasUser->name)) {
            session_start();
            $_SESSION['nome'] = $hasUser->name;
            $_SESSION['email'] = $hasUser->email;

            return redirect()->route('app.home');
        } else {
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

    public function sair() {
        session_destroy();
        return redirect()->route('site.index');
    }
}
