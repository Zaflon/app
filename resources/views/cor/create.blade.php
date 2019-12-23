@extends('index.index')

@section('conteudo')

<form action="{{ route('Cor.store') }}" method='POST'>
    @csrf
    <label for="ds_cor">Cor</label>
    <input type="text" name="ds_cor" required><br />

    <label for="ds_hexadecimal">Hexadecimal</label>
    <input type="text" name="ds_hexadecimal" required><br />

    <button type="submit" value="Save">Salvar</button>
</form

@endsection