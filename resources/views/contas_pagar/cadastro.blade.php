@extends('principal')
@section('title', 'Cadastrar Conta')

@section('content')

<h1>Cadastro de Contas</h1>
@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Erros:</strong>
		<ul>
        @foreach($errors->all() as $error)
			<li> {{$error}} </li>
		@endforeach
		</ul>
	</div>
@endif
<form action="/salvar" method="POST" >
<input type="hidden" name="_token" value="{{{csrf_token()}}}">
<input type="hidden" name="operation" value="I">
	<div class="form-group">
			<label>Descrição: </label>
			<input type="text" name="descricao" class="form-control" value="{{old('descricao')}}" />
	</div>
	<div class="form-group">
			<label>Valor: </label>
			<input type="text" name="valor" class="form-control" value="{{old('valor')}}" />
	</div>
	<button type="submit" class="btn btn-success">
		Cadastrar
	</button>

</form>
@stop