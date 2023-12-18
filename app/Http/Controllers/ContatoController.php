<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request) {

        $motivo_contatos = MotivoContato::all();

        // Method 1 - individual
        // $contato = new SiteContato();
        // $contato->nome = $request->input('nome');
        // $contato->telefone = $request->input('telefone');
        // $contato->email = $request->input('email');
        // $contato->motivo_contato = $request->input('motivo_contato');
        // $contato->mensagem = $request->input('mensagem');

        // // print_r($contato->getAttributes());
        // $contato->save();

        // Method 2 - fill -> need fillable
        // $contato = new SiteContato();
        // $contato->fill($request->all());
        // $contato->save();

        // Method 3 - create - needs fillable
        // $contato = new SiteContato();
        // $contato->create($request->all());

        return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request) {

        $regras = [
            // unique on name only for testing purposes - can be used for example for nicknames
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone'=> 'required',
            'email'=> 'email',
            'motivo_contatos_id'=> 'required',
            'mensagem'=> 'required|max:2000'
        ];

        $feedback = [
            'nome.min' => 'O campo nome precisa ter mais que 3 caracteres',
            'nome.max' => 'O campo nome precisa ter menos que 40 caracteres',
            'nome.unique' => 'O campo nome precisa ser unico',
            'email.email' => 'O email informado nao e valido',
           
            'required' => 'O campo :attribute precisa ser preenchido'
        ];

        // field validation
        $request->validate($regras, $feedback);
        SiteContato::create($request->all());
        return redirect()->route('/');
    }
}
