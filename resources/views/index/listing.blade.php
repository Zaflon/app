@extends('index.index')

@section('conteudo')

<table class="table table-hover">

    <thead>
        @foreach($view->header as $key => $header)
        <th scope="col">{{$header->alias}}</th>
        @endforeach
    </thead>

    <!-- FOREACH IN EACH REGISTER -->

    @foreach($view->list as $key => $dado)

        <tr id="{{ $dado->id }}">

            <!-- FOREACH IN EACH COLUMN -->
            
            @foreach($view->header as $kkey => $field)

                @if($field->type === 'column')
                    <td>
                        <span>{{ $dado->{$field->body} }}</span>
                    </td>
                @else
                    @switch($field->type)
                        @case('info')
                            <td>
                                <a onclick="App.Show( `{{ $dado->id }}` )" class="alias">
                                    <img title="More Information?" src="https://img.icons8.com/nolan/32/info.png">
                                </a>
                            </td>
                            @break

                        @case('edit')
                            <td>
                                <a href="{{ route("{$view->controller}.edit", $dado->id) }}">
                                    <img title="Edit?" src="https://img.icons8.com/nolan/32/multi-edit.png">
                                </a>
                            </td>
                            @break

                        @case('delete')
                            <td>
                                <a onclick="App.Del( `{{ $dado->id }}` )">
                                    <img title="Delete?" src="https://img.icons8.com/nolan/32/delete-sign.png">
                                </a>
                            </td>
                            @break
                        
                        @case('hexadecimal')
                            <td>
                                {!! html_entity_decode( App\Helpers\Html::span($dado, $field->type, $field) ) !!}
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

@if($view->paginate->total > ($view->paginate->current_page - 1) * $view->paginate->per_page)
    <!-- PAGINATION -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">

            <!-- 🔙 PREVIOUS 🔙 -->
            @if($view->paginate->current_page === 1)
                <li class="page-item disabled">
                    <a class="page-link" href="{{ $view->paginate->first_page_url }}" tabindex="-1">
                        Previous
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $view->paginate->first_page_url }}" tabindex="-1">
                        Previous
                    </a>
                </li>
            @endif

            <!-- 🔛 OPTION: BEGIN 🔛 -->
            @if($view->paginate->current_page === 1)
                <!-- 👻 WE ARE HERE 👻 -->
                <li class="page-item disabled">
                    <a class="page-link" href="{{ $view->paginate->path.'?page=' . ($view->paginate->current_page) }}">
                        {{ $view->paginate->current_page }}
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{ $view->paginate->path.'?page=' . ($view->paginate->current_page + 1) }}">
                        {{ $view->paginate->current_page + 1 }}
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{ $view->paginate->path.'?page=' . ($view->paginate->current_page + 2) }}">
                        {{ $view->paginate->current_page + 2 }}
                    </a>
                </li>
            <!-- 🔛 OPTION: END 🔛 -->
            @elseif($view->paginate->current_page === $view->paginate->last_page)
                <li class="page-item">
                    <a class="page-link" href="{{ $view->paginate->path.'?page='.($view->paginate->current_page - 2) }}">
                        {{ $view->paginate->last_page - 2}}
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{ $view->paginate->prev_page_url }}">
                        {{ $view->paginate->last_page - 1}}
                    </a>
                </li>
                <!-- 👻 WE ARE HERE 👻 -->
                <li class="page-item disabled">
                    <a class="page-link" href="{{ $view->paginate->current_page }}">
                        {{ $view->paginate->last_page}}
                    </a>
                </li>
            <!-- 🔛 OPTION: MIDDLE 🔛 -->
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $view->paginate->prev_page_url }}">
                        {{ $view->paginate->current_page - 1}}
                    </a>
                </li>
                <!-- 👻 WE ARE HERE 👻 -->
                <li class="page-item disabled">
                    <a class="page-link" href="#">
                        {{ $view->paginate->current_page }}
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{ $view->paginate->next_page_url }}">
                        {{ $view->paginate->current_page + 1}}
                    </a>
                </li>
            @endif

            <!-- 🔚 NEXT 🔚 -->
            @if($view->paginate->current_page === $view->paginate->last_page)
                <li class="page-item disabled">
                    <a class="page-link" href="{{ $view->paginate->last_page_url }}">
                        Next
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $view->paginate->last_page_url }}"
                        >Next
                    </a>
                </li>
            @endif

            <!-- 📜 DISPLAY MESSAGE 📜 -->
            <li class="page-item disabled">
                <a class="page-link" href="#">
                    Showing {{ $view->paginate->per_page }} of {{ $view->paginate->total }} registers
                </a>
            </li>

        </ul>
    </nav>
@endif

@endsection