@extends('template')
@section('title','Listagem de pacientes')

@section('content')

<div>
  <hi-pacienteList  
  url="{{route('api.pacientes')}}"
  novo_url="{{route('pacientes.create')}}"
  ver_url="{{route('pacientes.show','__id__')}}"  ></hi-pacienteList>
</div>

@endsection
