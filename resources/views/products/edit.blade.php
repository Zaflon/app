@extends("index.index")

@section("conteudo")

<form action="{{ route($view->controller.'.update', $view->register->id) }}" method='POST'>

    @csrf

    @method('PUT')

    <div class="form-group">
        <label for="id">Code</label>
        <input type="text" class="form-control" name="id" value="{{ $view->register->id }}" readonly>
    </div>

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" value="{{ $view->register->name }}" placeholder="Product Name">
    </div>

    <div class="form-group">
        <label for="info">Information</label>
        <input type="text" class="form-control" name="info" value="{{ $view->register->info }}" placeholder="Information">
    </div>

    <div class="form-group">
        <label for="detail">More Details</label>
        <input type="text" class="form-control" name="detail" value="{{ $view->register->detail }}" placeholder="Product Detail">
    </div>

    <div class="form-group">
        <label for="brand_id">Brand</label>
        
        <select type="text" class="form-control" name="brand_id" placeholder="Brand Name">
            @foreach($brands as $key => $brand)
                @if($brand->id === $view->register->brand_id)
                    <option value="{{ $brand->id }}" selected="{{ $view->register->brand_id }}">{{$brand->name}}</option>
                @else
                    <option value="{{ $brand->id }}">{{$brand->name}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="weight">Weight (Grams)</label>
        <input type="text" class="form-control" name="weight" value="{{ $view->register->weight }}" placeholder="Product Weight">
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