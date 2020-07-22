@extends('index.index')

@section('conteudo')

<form action="{{ route($view->controller.'.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label for="color">Color</label>
        <input type="text" class="form-control" name="color" placeholder="Color Name" required>
    </div>

    <div class="form-group">
        <label for="hexadecimal">Hexadecimal</label>
        <input type="color" class="form-control" name="hexadecimal" value="FFFFFF" required>
    </div>

    <button type="submit" value="Save" class="btn btn-success btn-lg">Save</button>

    @foreach($errors->all() as $error)
        @component('components.error', ['error' => $error])
        @endcomponent
    @endforeach

</form>

@endsection