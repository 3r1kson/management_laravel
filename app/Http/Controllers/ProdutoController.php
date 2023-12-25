<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produtos = Produto::paginate(10);

    return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // this function direct to the page to register the product adding the list of units from the fk
        $unidades = Unidade::all();
        return view('app.produto.create',['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // this function saves the new product in the database

        $msg = '';

        // register method
        if($request->input('_token') != '' && $request->input('id') == '') {

            $regras = [
                // unique on name only for testing purposes - can be used for example for nicknames
                'nome' => 'required|min:3|max:40',
                'descricao'=> 'required|min:3|max:2000',
                'peso' => 'required|integer',
                'unidade_id'=> 'exists:unidades,id'
            ];
    
            $feedback = [
                'nome.min' => 'O campo nome precisa ter mais que 3 caracteres',
                'nome.max' => 'O campo nome precisa ter menos que 40 caracteres',
                'descricao.min' => 'O campo descricao precisa ter mais que 3 caracteres',
                'descricao.max' => 'O campo descricao precisa ter menos que 2000 caracteres',
                'peso.integer' => 'O campo peso precisa ser numero',
                'unidade_id.exists' => 'A unidade de medida informada nao existe',
               
                'required' => 'O campo :attribute precisa ser preenchido'
            ];
            
            $request->validate($regras, $feedback);

            Produto::create($request->all());
            $msg = 'Cadastro realizado com Sucesso';
        }

        // // edit method
        // if($request->input('_token') != '' && $request->input('id') != '') {
        //     $produto = Fornecedor::find($request->input('id'));
        //     $update = $fornecedor->update($request->all());

        //     $update ? $msg = 'Cadastro atualizado' : $msg = 'Erro ao tentar atualizar o registro' ;

        //     return redirect()->route('app.fornecedor.edit', ['id' => $request->input('id'), 'msg' => $msg]);
        // }
        
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show',['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produto.index');
    }
}
