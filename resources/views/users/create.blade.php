@extends("index.index")

@section("conteudo")

<form action="{{ route($view->controller.'.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" required>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col">
                <label for="first-password">Password</label>
                <input type="password" class="form-control" name="first-password" required>
            </div>
            <div class="col">
                <label for="second-password">Confirm Password</label>
                <input type="password" class="form-control" name="second-password" required>
            </div>
        </div>
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