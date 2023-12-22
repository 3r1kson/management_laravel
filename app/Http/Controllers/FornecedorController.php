<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{
    public function index() {
        return view('app.fornecedor.index');
    }

    public function list() {
        return view('app.fornecedor.list');
    }

    public function add(Request $request) {
        $msg = '';

        if($request->input('_token') != '') {

            $regras = [
                // unique on name only for testing purposes - can be used for example for nicknames
                'nome' => 'required|min:3|max:40',
                'site'=> 'required',
                'uf' => 'required|min:2|max:2',
                'email'=> 'email'
            ];
    
            $feedback = [
                'nome.min' => 'O campo nome precisa ter mais que 3 caracteres',
                'nome.max' => 'O campo nome precisa ter menos que 40 caracteres',
                'uf.min' => 'O campo uf precisa ter no minimo 2 caracteres',
                'uf.max' => 'O campo uf precisa ter no maximo 2 caracteres',
                'email.email' => 'O email informado nao e valido',
               
                'required' => 'O campo :attribute precisa ser preenchido'
            ];
            
            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            $msg = 'Cadastro realizado com Sucesso';
        }

        return view('app.fornecedor.add', ['msg' => $msg]);
    }
}
