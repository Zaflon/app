@extends('index.index')

@section('conteudo')

<div class="overflow-auto h-75">
    <table class="table table-hover">

        <thead>
            @foreach($view->header as $key => $header)
                <th scope="col">{{ $header->{\App\Helpers\DOM::ALIAS} }}</th>
            @endforeach
        </thead>

        {{-- FOREACH IN EACH REGISTER --}}

        @foreach($view->list as $key => $line)

        <tr id="{{ $line->id }}">

            {{-- FOREACH IN EACH COLUMN --}}

            @foreach($view->header as $kkey => $column)

                @switch($column->{\App\Helpers\DOM::TYPE})

                    {{-- 📣 MORE INFORMATION 📣 --}}

                    @case(\App\Helpers\DOM::__INFORMATION)
                        <td>
                            <a onclick="Common.Show( `{{ $line->id }}` )" class="alias">
                                <img title="More Information?" src="https://img.icons8.com/nolan/32/info.png">
                            </a>
                        </td>
                    @break

                    {{-- 📝 EDITION 📝 --}}

                    @case(\App\Helpers\DOM::__EDITION)
                        <td>
                            <a href="{{ route("{$view->controller}.edit", $line->id) }}">
                                <img title="Edit?" src="https://img.icons8.com/nolan/32/multi-edit.png">
                            </a>
                        </td>
                    @break

                    {{-- ❌ DELETE ❌ --}}

                    @case(\App\Helpers\DOM::__DELETE)
                        <td>
                            <a onclick="Common.Del( `{{ $line->id }}` )">
                                <img title="Delete?" src="https://img.icons8.com/nolan/32/delete-sign.png">
                            </a>
                        </td>
                    @break

                    {{-- 🎨 HEXADECIMAL COLOR 🎨 --}}

                    @case(\App\Helpers\DOM::__HEXADECIMAL)
                        <td>
                            {!!
                                \App\Helpers\DOM::DOM()
                                    ->__set(\App\Helpers\DOM::COMPONENT, \App\Helpers\DOM::__SPAN)
                                    ->__set(\App\Helpers\DOM::__CLASS, 'dot')
                                    ->__set(\App\Helpers\DOM::__BACKGROUND_COLOR, \App\Helpers\Utils::extract( $column->{ \App\Helpers\DOM::BODY }, $line ) )
                                ->Render()
                            !!}
                        </td>
                    @break

                    {{-- 📃 SAMPLE SPAN WITH SOME TEXT 📃 --}}

                    @case(\App\Helpers\DOM::__COLUMN)
                        <td>
                            <span>{{ \App\Helpers\Utils::extract( $column->{ \App\Helpers\DOM::BODY }, $line ) }}</span>
                        </td>
                    @break

                    {{-- 💢 ERROR 💢 --}}

                    @default
                        {{ "An error occurred. Please contact support" }}

                @endswitch

            @endforeach

        </tr>

        @endforeach

    </table>
</div>

@if($view->paginate->total > ($view->paginate->current_page - 1) * $view->paginate->per_page)
{{-- PAGINATION --}}
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">

        {{-- 🔙 PREVIOUS 🔙 --}}
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

        {{-- 🔛 OPTION: BEGIN 🔛 --}}
        @if($view->paginate->current_page === 1)
        {{-- 👻 WE ARE HERE 👻 --}}
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
        {{-- 🔛 OPTION: END 🔛 --}}
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
        {{-- 👻 WE ARE HERE 👻 --}}
        <li class="page-item disabled">
            <a class="page-link" href="{{ $view->paginate->current_page }}">
                {{ $view->paginate->last_page}}
            </a>
        </li>
        {{-- 🔛 OPTION: MIDDLE 🔛 --}}
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $view->paginate->prev_page_url }}">
                {{ $view->paginate->current_page - 1}}
            </a>
        </li>
        {{-- 👻 WE ARE HERE 👻 --}}
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

        {{-- 🔚 NEXT 🔚 --}}
        @if($view->paginate->current_page === $view->paginate->last_page)
        <li class="page-item disabled">
            <a class="page-link" href="{{ $view->paginate->last_page_url }}">
                Next
            </a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $view->paginate->last_page_url }}">Next
            </a>
        </li>
        @endif

        {{-- 📜 DISPLAY MESSAGE 📜 --}}
        <li class="page-item disabled">
            <a class="page-link" href="#">
                Showing {{ $view->paginate->per_page }} of {{ $view->paginate->total }} registers
            </a>
        </li>

    </ul>
</nav>
@endif

@endsection