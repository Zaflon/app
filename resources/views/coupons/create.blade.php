@extends('index.index')

@section('conteudo')

<form action="{{ route($view->controller.'.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Name" required>
    </div>

    <div class="form-group">
        <label for="detail">More Details</label>
        <input type="text" class="form-control" name="detail" placeholder="More Details" required>
    </div>

    <div class="form-group">
        <label for="price">Price (Cents)</label>
        <input type="text" class="form-control" name="price" placeholder="0" required>
    </div>

    <button type="submit" value="Save" class="btn btn-success btn-lg">
        Save
    </button>

    @foreach($errors->all() as $error)
        @component('components.error', ['error' => $error])
        @endcomponent
    @endforeach

</form>

@endsection