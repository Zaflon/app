@extends('index.index')

@section('conteudo')

<form action="{{ route($view->controller.'.update', $view->register->id) }}" method='POST'>

    @csrf

    @method('PUT')

    <div class="form-group">
        <label for="id">Code</label>
        <input class="form-control" type="text" name="id" value={{ $view->register->id }} readonly>
    </div>

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" value={{ $view->register->name }} required>
    </div>

    <div class="form-group">
        <label for="detail">More Details</label>
        <input type="text" class="form-control" name="detail" value={{ $view->register->detail }} required>
    </div>

    <div class="form-group">
        <label for="price">Price (Cents)</label>
        <input type="text" class="form-control" name="price" value={{ $view->register->price }} required>
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