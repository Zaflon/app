@extends('index.index')

@section('conteudo')

<form action="{{ route('Color.store') }}" method='POST'>
    @csrf
    <label for="color">Color</label>
    <input type="text" name="color" placeholder="Color Name" required><br />

    <label for="hexadecimal">Hexadecimal</label>
    <input type="color" name="hexadecimal" value="FFFFFF" required><br />

    <button type="submit" value="Save">Salvar</button>

    @foreach($errors->all() as $error)
        @component('components.error', ['error' => $error])
        @endcomponent
    @endforeach

</form>

@endsection