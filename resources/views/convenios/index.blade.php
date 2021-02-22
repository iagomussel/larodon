@extends('template')
@section('title', 'Listagem de convenios')

@section('content')

    <div>
        <hi-convenioList url="{{ route('api.convenios') }}" novo_url="{{ route('convenios.create') }}"
            ver_url="{{ route('convenios.show', '__id__') }}">
            </hi-conveniosList>
    </div>
@endsection
