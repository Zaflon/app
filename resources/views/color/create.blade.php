@extends('index.index')

@section('conteudo')

<form action="{{ route('Color.store') }}" method='POST'>
    @csrf
    <label for="color">Color</label>
    <input type="text" name="color" placeholder="Color Name" required><br />

    <label for="hexadecimal">Hexadecimal</label>
    <input type="text" name="hexadecimal" placeholder="Hexadecimal Value" required><br />

    <button type="submit" value="Save">Salvar</button>

    <!-- TODO Transformar esse trecho de código em um componente -->
    @foreach($errors->all() as $error)
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
        <div class="toast-header">
            <img src="https://img.icons8.com/material/24/000000/settings--v3.png" class="rounded mr-2" alt="...">
            <strong class="mr-auto">CRUD Error Message</strong>
            <small>1 sec ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ $error }}
        </div>
    </div>
    @endforeach

</form> @endsection