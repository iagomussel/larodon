@extends('template')
@section('title','Novo Paciente')

@section('content')

<form method="POST" action="{{route('convenios.store')}}" role="form">
		@csrf
		<div class="form-group">
			<label for="nome">Nome</label> 
		  <input id="nome" name="nome" placeholder="Nome" type="text" required="required" class="form-control">
		  </div>
		 
		<div class="form-group">
		  <button name="submit" type="submit" class="btn btn-primary">Gravar</button>
		</div>
	  </form>
@endsection
