@extends('app.layouts.basico')

@section('titulo', 'Fornecedores')

@section('conteudo')
<div class="conteudo-pagina">
    <div class="titulo-pagina-2">
        <p>Listar</p>
    </div>
    <div class="menu">
        <ul>
            <li><a href="{{ route('app.fornecedor.add') }}">Novo</a></li>
            <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
        </ul>
    </div>
    <div class="informacao-pagina">
        <div style="width:90%; margin-left: auto; margin-right: auto;">
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Site</th>
                        <th>UF</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fornecedores as $fornecedor )
                        <tr>
                            <td>{{$fornecedor->nome}}</td>
                            <td>{{$fornecedor->site}}</td>
                            <td>{{$fornecedor->uf}}</td>
                            <td>{{$fornecedor->email}}</td>
                            <td><a href="{{ route('app.fornecedor.exclude', $fornecedor->id) }}">Excluir</a></td>
                            <td><a href="{{ route('app.fornecedor.edit', $fornecedor->id) }}">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $fornecedores->appends($request)->links() }}

            {{--
            <br>
            {{ $fornecedores->count()}} - Total de registros por pagina
            <br>
            {{ $fornecedores->total()}} - Total de registros
            <br>
            {{ $fornecedores->firstItem()}} - Numero do primeiro registro da pagina
            {{ $fornecedores->lastItem()}} - Numero do ultimo registro da pagina 
            --}}

            Exibindo {{ $fornecedores->count()}} fornecedores de {{ $fornecedores->total()}} registros (de {{ $fornecedores->firstItem()}} a {{ $fornecedores->lastItem()}})
        </div>
    </div>
</div>
@endsection