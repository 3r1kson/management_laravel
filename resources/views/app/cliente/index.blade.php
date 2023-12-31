@extends('app.layouts.basico')

@section('titulo', 'Clientes')

@section('conteudo')
<div class="conteudo-pagina">
    <div class="titulo-pagina-2">
        <p>Cliente - Listar</p>
    </div>
    <div class="menu">
        <ul>
            <li><a href="{{ route('cliente.create') }}">Novo</a></li>
            <li><a href="">Consulta</a></li>
        </ul>
    </div>
    <div class="informacao-pagina">
        <div style="width:90%; margin-left: auto; margin-right: auto;">
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente )
                        <tr>
                            <td>{{$cliente->nome}}</td>

                            <td><a href="{{ route('cliente.show', ['cliente' => $cliente->id]) }}">Visualizar</a></td>
                            <td>
                                <form id="form_{{$cliente->id}}" method="post" action="{{ route('cliente.destroy', ['cliente' => $cliente->id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    {{-- <button type="submit">Excluir</button> --}}
                                    <a href="#" onclick="document.getElementById('form_{{$cliente->id}}').submit()">Excluir</a>
                                </form>
                            </td>
                            <td><a href="{{ route('cliente.edit', ['cliente' => $cliente->id])}}">Editar</a></td>
                            {{-- <td><a href="{{ route('app.fornecedor.exclude', $produto->id) }}">Excluir</a></td>
                            <td><a href="{{ route('app.fornecedor.edit', $produto->id) }}">Editar</a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $clientes->appends($request)->links() }}

            {{--
            <br>
            {{ $clientes->count()}} - Total de registros por pagina
            <br>
            {{ $clientes->total()}} - Total de registros
            <br>
            {{ $clientes->firstItem()}} - Numero do primeiro registro da pagina
            {{ $clientes->lastItem()}} - Numero do ultimo registro da pagina 
            --}}
                <br>
            Exibindo {{ $clientes->count()}} clientes de {{ $clientes->total()}} registros (de {{ $clientes->firstItem()}} a {{ $clientes->lastItem()}})
        </div>
    </div>
</div>
@endsection