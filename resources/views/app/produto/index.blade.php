@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')
<div class="conteudo-pagina">
    <div class="titulo-pagina-2">
        <p>Produto - Listar</p>
    </div>
    <div class="menu">
        <ul>
            <li><a href="{{ route('produto.create') }}">Novo</a></li>
            <li><a href="">Consulta</a></li>
        </ul>
    </div>
    <div class="informacao-pagina">
        <div style="width:90%; margin-left: auto; margin-right: auto;">
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descricao</th>
                        <th>Peso</th>
                        <th>Unidade ID</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto )
                        <tr>
                            <td>{{$produto->nome}}</td>
                            <td>{{$produto->descricao}}</td>
                            <td>{{$produto->peso}}</td>
                            <td>{{$produto->unidade_id}}</td>
                            <td><a href="">Excluir</a></td>
                            <td><a href="">Editar</a></td>
                            {{-- <td><a href="{{ route('app.fornecedor.exclude', $produto->id) }}">Excluir</a></td>
                            <td><a href="{{ route('app.fornecedor.edit', $produto->id) }}">Editar</a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $produtos->appends($request)->links() }}

            {{--
            <br>
            {{ $produtos->count()}} - Total de registros por pagina
            <br>
            {{ $produtos->total()}} - Total de registros
            <br>
            {{ $produtos->firstItem()}} - Numero do primeiro registro da pagina
            {{ $produtos->lastItem()}} - Numero do ultimo registro da pagina 
            --}}
                <br>
            Exibindo {{ $produtos->count()}} fornecedores de {{ $produtos->total()}} registros (de {{ $produtos->firstItem()}} a {{ $produtos->lastItem()}})
        </div>
    </div>
</div>
@endsection