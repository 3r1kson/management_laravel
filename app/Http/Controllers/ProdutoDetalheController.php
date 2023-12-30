<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProdutoDetalhe;
use App\ItemDetalhe;
use App\Unidade;

class ProdutoDetalheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidade::all();
        return view('app.produto_detalhe.create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->produto_id);
        if($request->produto_id);
        $regras = [
            // unique on name only for testing purposes - can be used for example for nicknames
            'produto_id' => 'required|min:1|max:40',
            'comprimento'=> 'required|min:1|max:10',
            'largura' => 'required|min:1|max:10',
            'altura' => 'required|min:1|max:10',
            'unidade_id'=> 'exists:unidades,id'
        ];

        $feedback = [
            'produto_id.min' => 'O campo nome precisa ter mais que 3 caracteres',
            'produto_id.max' => 'O campo nome precisa ter menos que 40 caracteres',
            'comprimento.min' => 'O campo descricao precisa ter mais que 3 caracteres',
            'comprimento.max' => 'O campo descricao precisa ter menos que 10 caracteres',
            'altura.min' => 'O campo descricao precisa ter mais que 3 caracteres',
            'altura.max' => 'O campo descricao precisa ter menos que 10 caracteres',
            'unidade_id.exists' => 'A unidade de medida informada nao existe',
           
            'required' => 'O campo :attribute precisa ser preenchido'
        ];
        
        $request->validate($regras, $feedback);

        ProdutoDetalhe::create($request->all());
        echo 'dados cadastrados';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

/**
     * Show the form for editing the specified resource.
     *
     * @param  App\ProdutoDetalhe  $produtoDetalhe
     * @return \Illuminate\Http\Response
     */
    public function edit($produtoDetalheID)
    {
        // $produtoDetalhe = (ProdutoDetalhe::all()->where('produto_id', $produtoDetalheID)->all());
        // inserting eager loading for $produtoDetalhe
        $produtoDetalhe = ItemDetalhe::with(['item'])->find($produtoDetalheID)->all();
        $unidades = Unidade::all();
        return view('app.produto_detalhe.edit', ['produto_detalhe' => $produtoDetalhe, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\ProdutoDetalhe  $produtoDetalhe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdutoDetalhe $produtoDetalhe)
    {
        $produtoDetalhe->update($request->all());
        echo 'Atualizacao foi realizada com sucesso';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
