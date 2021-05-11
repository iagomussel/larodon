@extends('template')
@section('title', 'Paciente')
@section('content')

    <form method="POST" action="{{ route('procedimentos.update', $procedimento->id) }}" role="form">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group">
            <label for="nome">Procedimento</label>
            <input value="{{ $procedimento->nome }}" id="nome" name="nome" placeholder="Limpeza, extração, etc.."
                type="text" required="required" class="form-control">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" cols="40" rows="5"
                class="form-control">{{ $procedimento->descricao }}</textarea>
        </div>
        <div class="form-group">
            <button name="submit" type="submit" class="btn btn-primary">Gravar</button>
        </div>
    </form>


@endsection
