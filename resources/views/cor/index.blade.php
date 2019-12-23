@extends('index.index')

@section('conteudo')

<table class="table">

    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Descrição</th>
            <th scope="col">Hexadecimal</th>
            <th scope="col">Informação</th>
            <th scope="col">Edição</th>
            <th scope="col">Exclusão</th>
            <th scope="col">Imagem</th>
        </tr>
    </thead>

    @foreach($data->list as $key => $dado)
    <tr>
        <th scope="row">
            {{$dado->cd_cor}}
        </th>

        <td>
            {{ $dado->ds_cor }}
        </td>

        <td>
            {{ $dado->ds_hexadecimal }}
        </td>

        <td>
            <a href="{{ route('Cor.show', $dado->cd_cor) }}">Info</a>
        </td>

        <td>
            <a href="{{ route('Cor.edit', $dado->cd_cor) }}">Edição</a>
        </td>

        <td>
            <form action="{{ route('Cor.destroy', $dado->cd_cor) }}" method="POST">

                @csrf

                @method('DELETE')

                <input type="submit" value="Deletar">

            </form>
        </td>

        <td>
            <span class="dot" style="background-color: #{{$dado->ds_hexadecimal}};"></span>
        </td>

    </tr>
    @endforeach

</table>

@endsection