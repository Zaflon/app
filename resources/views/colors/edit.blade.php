@extends('index.index')

@section('conteudo')

<form action="{{ route($view->controller.'.update', $view->register->id) }}" method='POST'>

    @csrf

    @method('PUT')

    <div class="form-group">
        <label for="id">Code</label>
        <input class="form-control" type="text" name="id" value={{$view->register->id}} readonly>
    </div>

    <div class="form-group">
        <label for="color">Color</label>
        <input class="form-control" type="text" name="color" value={{$view->register->color}} required >
    </div>

    <div class="form-group">
        <label for="hexadecimal" title={{$view->register->hexadecimal}}>Hexadecimal</label>
        <input class="form-control" type="color" name="hexadecimal" value="#{{$view->register->hexadecimal}}" required>
    </div>

    <button type="submit" class="btn btn-success btn-lg" value="Save">
        Save
    </button>

    @foreach($errors->all() as $error)
        @component('components.error', ['error' => $error])
        @endcomponent
    @endforeach

</form>

@endsection