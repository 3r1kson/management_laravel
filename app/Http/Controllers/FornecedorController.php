<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{
    public function index() {
        return view('app.fornecedor.index');
    }

    public function list(Request $request) {

        // dd($request->all());

        $fornecedores = Fornecedor::where('nome', 'like', '%'.$request->input('nome').'%')
            ->where('site', 'like', '%'.$request->input('site').'%')
            ->where('uf', 'like', '%'.$request->input('uf').'%')
            ->where('email', 'like', '%'.$request->input('email').'%')
            ->get();

        return view('app.fornecedor.list', ['fornecedores' => $fornecedores]);
    }

    public function add(Request $request) {
        $msg = '';

        // register method
        if($request->input('_token') != '' && $request->input('id') == '') {

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

        // edit method
        if($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            $update ? $msg = 'Cadastro atualizado' : $msg = 'Erro ao tentar atualizar o registro' ;

            return redirect()->route('app.fornecedor.edit', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.add', ['msg' => $msg]);
    }

    public function edit($id, $msg = '') {
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.add', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }
}
