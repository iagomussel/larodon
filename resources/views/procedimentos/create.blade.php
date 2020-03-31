@extends('template')
@section('title','Novo Procedimento')

@section('content')

<form method="POST" action="{{route('procedimentos.store')}}" role="form">
		@csrf
	<div class="form-group">
	  <label for="nome">Procedimento</label> 
	  <input id="nome" name="nome" placeholder="Limpeza, extração, etc.." type="text" required="required" class="form-control">
	</div>
	<div class="form-group">
	  <label for="descricao">Descrição</label> 
	  <textarea id="descricao" name="descricao" cols="40" rows="5" class="form-control"></textarea>
	</div> 
	<div class="form-group">
	  <button name="submit" type="submit" class="btn btn-primary">Gravar</button>
	</div>
  </form>
  
  
@endsection
