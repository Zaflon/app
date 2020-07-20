@extends("index.index")

@section("conteudo")

<form action="{{ route($view->controller.'.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Product Name">
    </div>

    <div class="form-group">
        <label for="detail">Detail</label>
        <input type="text" class="form-control" name="detail" placeholder="Product Detail">
    </div>

    <div class="form-group">
        <label for="brand_id">Brand Code</label>
        <input type="text" class="form-control" name="brand_id" placeholder="Brand Code">
    </div>

    <div class="form-group">
        <label for="weight">Weight</label>
        <input type="text" class="form-control" name="weight" placeholder="Product Weight">
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