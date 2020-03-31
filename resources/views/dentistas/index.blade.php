@extends('template')
@section('title','Listagem de dentistas');

@section('content')

<div>
  <hi-dentistaList  
  url="{{route('api.dentistas')}}"
  novo_url="{{route('dentistas.create')}}"
  ver_url="{{route('dentistas.show','__id__')}}"  ></hi-dentistaList>
</div>

@endsection