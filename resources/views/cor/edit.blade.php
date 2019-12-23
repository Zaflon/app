@extends('index.index')

@section('conteudo')

<form action="{{ route('Cor.update', $data->list->cd_cor) }}" method='POST'>
    @csrf
    @method('PUT')
    <label for="cd_cor">Código</label>
    <input type="text" name="cd_cor" value={{$data->list->cd_cor}} readonly><br />

    <label for="ds_cor">Cor</label>
    <input type="text" name="ds_cor" value={{$data->list->ds_cor}}><br />

    <label for="ds_hexadecimal">Hexadecimal</label>
    <input type="text" name="ds_hexadecimal" value={{$data->list->ds_hexadecimal}}>

    <button type="submit" value="Save">Salvar</button>
</form

@endsection