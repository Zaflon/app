@extends('index.index')

@section('conteudo')

<form action="{{ route('Color.update', $view->register->id) }}" method='POST'>
    @csrf
    @method('PUT')
    <label for="id">Código</label>
    <input type="text" name="id" value={{$view->register->id}} readonly><br />

    <label for="color">Color</label>
    <input type="text" name="color" value={{$view->register->color}}><br />

    <label for="hexadecimal" title={{$view->register->hexadecimal}}>Hexadecimal</label>
    <input type="color" name="hexadecimal" value="#{{$view->register->hexadecimal}}">

    <button type="submit" value="Save">Salvar</button>

    @foreach($errors->all() as $error)
        @component('components.error', ['error' => $error])
        @endcomponent
    @endforeach

</form>

@endsection