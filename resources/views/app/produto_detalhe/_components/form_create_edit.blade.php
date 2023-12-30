@if(isset($produto_detalhe[0]->id))
    <form method="post" action="{{ route('produto-detalhe.update', ['produto_detalhe' => $produto_detalhe[0]]) }}">
        @csrf
        @method('PUT')
@else
<form method="post" action="{{ route('produto-detalhe.store') }}">
    @csrf
@endif
    <input type="text" value="{{ $produto_detalhe[0]->produto_id ?? old('produto_id')}}" name="produto_id" placeholder="Produto ID" class="borda-preta">
    {{ $errors->has('produto_id') ? $errors->first('produto_id') : ''}}
    <input type="text" value="{{ $produto_detalhe[0]->comprimento ?? old('comprimento')}}" name="comprimento" placeholder="Comprimento" class="borda-preta">
    {{ $errors->has('comprimento') ? $errors->first('comprimento') : ''}}
    <input type="text" value="{{ $produto_detalhe[0]->largura ?? old('largura')}}" name="largura" placeholder="Largura" class="borda-preta">
    {{ $errors->has('largura') ? $errors->first('largura') : ''}}
    <input type="text" value="{{ $produto_detalhe[0]->altura ?? old('altura')}}" name="altura" placeholder="Altura" class="borda-preta">
    {{ $errors->has('altura') ? $errors->first('altura') : ''}}
    <select name="unidade_id">
        <option>-- Selecione a unidade de medida</option>
        @foreach ($unidades as $unidade)
            <option value="{{ $unidade->id }}" {{$produto_detalhe[0]->unidade_id ?? old('unidade_id') == $unidade->id  ? 'selected' : ' '}}>{{ $unidade->descricao }}</option>
        @endforeach
        
    </select>
    {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : ''}}
    @if(isset($produto_detalhe[0]->id))
    <button type="submit" class="borda-preta">Alterar</button>
    @else
    <button type="submit" class="borda-preta">Cadastrar</button>
    @endif
    
</form>