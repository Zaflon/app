@extends("index.index")

@section("conteudo")

<form action="{{ route($view->controller.'.update', $view->register->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="id">Primary Key</label>
        <input class="form-control" type="text" name="id" aria-describedby="id" value={{$view->register->id}} readonly>
    </div>

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" value={{$view->register->name}}>
    </div>
    
    <button type="submit" value="Save" class="btn btn-success btn-lg">
        Save
    </button>

    @foreach($errors->all() as $error)
        @component("components.error", ["error" => $error])
        @endcomponent
    @endforeach

</form>

@endsection