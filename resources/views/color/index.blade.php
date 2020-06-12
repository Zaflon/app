@extends('index.index')

@section('conteudo')

<table class="table table-hover">

    <thead>
        @foreach($data->header as $key => $header)
        <th scope="col">{{$header['alias']}}</th>
        @endforeach
    </thead>

    @foreach($data->list as $key => $dado)

        <tr id="{{ $dado['id'] }}">

            @foreach($data->header as $kkey => $field)

                @if($field['type'] === 'column')
                    <td>
                        <span>{{ $dado[$field['body']] }}</span>
                    </td>
                @else
                    @switch($field['type'])
                        @case('info')
                            <td>
                                <a onclick="App.Show( {{ $dado['id'] }} )" class="alias">
                                    <img title="More Information?" src="https://img.icons8.com/nolan/32/info.png">
                                </a>
                                
                            </td>
                            @break

                        @case('edit')
                            <td>
                                <a href="{{ route('Color.edit', $dado['id']) }}">
                                    <img title="Edit?" src="https://img.icons8.com/nolan/32/multi-edit.png">
                                </a>
                                
                            </td>
                            @break

                        @case('delete')
                            <td>
                                <a onclick="App.Del({{$dado['id']}})">
                                    <img title="Delete?" src="https://img.icons8.com/nolan/32/delete-sign.png">
                                </a>
                            </td>
                            @break
                        
                        @case('hexadecimal')
                            <td>
                                {{ Html::span("id_".$dado['id'], ["class" => "dot", "style" => "background-color: #{$dado[$field['body']]} "] ) }}
                            </td>
                            @break

                        @default
                            <span>Something went wrong, please try again</span>
                    @endswitch

                @endif

            @endforeach

        </tr>
        
    @endforeach

</table>

@endsection