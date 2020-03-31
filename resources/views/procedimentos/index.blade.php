@extends('template')
@section('title','Listagem de procedimentos');

@section('content')

<div>
  <hi-procedimentoList  
  url="{{route('api.procedimentos')}}"
  novo_url="{{route('procedimentos.create')}}"
  ver_url="{{route('procedimentos.show','__id__')}}"  ></hi-procedimentoList>
</div>

@endsection
