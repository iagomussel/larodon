@extends('template')
@section('title', 'Novo Dentista')
@section('content')


    <form method="POST" action="{{ route('dentistas.store') }}" role="form">
        @csrf
        <div class="form-group">
            <label for="nome">Nome</label>
            <input id="nome" name="nome" placeholder="Nome" type="text" required="required" class="form-control">
        </div>
        <div class="form-group">
            <label for="especializacao">Especialização</label>
            <input id="especializacao" name="especializacao" placeholder="Especialização" type="text" required="required"
                class="form-control">
        </div>

        <section>
            <label> Autenticação </label>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="Email" name="email" placeholder="mail@gmail.com" type="text" required="required"
                    class="form-control">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input id="senha" name="senha" placeholder="*****" type="password" required="required" class="form-control">
            </div>
        </section>
        <div class="form-group">
            <button name="submit" type="submit" class="btn btn-primary">Gravar</button>
        </div>
    </form>

@endsection
