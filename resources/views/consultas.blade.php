@extends('template')
@section('title','Agenda');

@section('content')

<div>
    <hi-scheduler
    url="{{route('api.consultas')}}"
    ></hi-scheduler>
</div>

@endsection
