@extends('template')
@section('title', 'Dentista')
@section('content')

    <form method="POST" action="{{ route('dentistas.update', $dentista->id) }}" role="form">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input id="nome" value="{{ $dentista->nome }}" name="nome" placeholder="Nome" type="text" required="required"
                class="form-control">
        </div>
        <div class="form-group">
            <label for="especializacao">Especialização</label>
            <input id="especializacao" value="{{ $dentista->especializacao }}" name="especializacao"
                placeholder="Especialização" type="text" required="required" class="form-control">
        </div>
        <div class="form-group">
            <button name="submit" type="submit" class="btn btn-primary">Gravar</button>
        </div>
    </form>

@endsection
