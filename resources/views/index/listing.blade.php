@extends('index.index')

@section('conteudo')

<table class="table table-hover">

    <thead>
        @foreach($view->header as $key => $header)
        <th scope="col">{{$header['alias']}}</th>
        @endforeach
    </thead>

    <!-- FOREACH IN EACH REGISTER -->

    @foreach($view->list as $key => $dado)

        <tr id="{{ $dado['id'] }}">

            <!-- FOREACH IN EACH COLUMN -->
            
            @foreach($view->header as $kkey => $field)

                @if($field['type'] === 'column')
                    <td>
                        <span>{{ $dado[$field['body']] }}</span>
                    </td>
                @else
                    @switch($field['type'])
                        @case('info')
                            <td>

                                <a onclick="App.Show( `{{ $dado['id'] }}` )" class="alias">
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
                                <a onclick="App.Del( `{{ $dado['id'] }}` )">
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

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>

@endsection