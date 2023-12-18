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

        // field validation
        $request->validate([
            'nome' => 'required|min:3|max:40',
            'telefone'=> 'required',
            'email'=> 'required',
            'motivo_contato'=> 'required',
            'mensagem'=> 'required|max:2000'
        ]);
        SiteContato::create($request->all());
    }
}
