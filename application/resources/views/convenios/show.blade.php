@extends('template')
@section('title', 'Convênio')
@section('content')

    <form method="POST" action="{{ route('convenios.update', $convenio->id) }}" role="form">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input id="nome" value="{{ $convenio->nome }}" name="nome" placeholder="Nome" type="text" required="required"
                class="form-control">
        </div>

        <div class="form-group">
            <button name="submit" type="submit" class="btn btn-primary">Gravar</button>
        </div>
    </form>
@endsection
