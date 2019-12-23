@extends('index.index')

@section('conteudo')

Código: {{$data->list->cd_cor}}
<br>
Hexadecimal: {{$data->list->ds_hexadecimal}}
<br>
Descrição: {{$data->list->ds_cor}}

@endsection