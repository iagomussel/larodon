@extends('principal')
@section('title', 'Listagem de Contas')

@section('content')
<script type="text/javascript">
	
	function apagar(url) {
		if(window.confirm('Deseja realmente apagar?')){
			window.location = url;
		}
	}

</script>

<h1>Lista de Contas Pagar</h1>

@if(old('operation') == 'I')
	<div class="alert alert-success">
		<strong>Sucesso</strong> 
		Cadastro realizado com sucesso.
	</div>
@endif

@if(old('operation') == 'U')
	<div class="alert alert-success">
		<strong>Sucesso</strong> 
		Conta {{ old('descricao') }} alterada com sucesso.
	</div>
@endif

<a class="btn btn-small btn-success" href="{{ action('ContasPagarController@cadastro') }}">Cadastrar</a>
<br>
<br>

<table width="100%" class="table table-striped table-bordered table-hover">
	<tr>
		<td>ID</td>
		<td>Descrição</td>
		<td>Valor</td>
		<td>Editar</td>
		<td>Apagar</td>
	</tr>
@foreach ($contas_pagar as $value)
	<tr>
		<td>
			{{ $value->id }}
		</td>
		<td>
			{{ $value->descricao }}
		</td>
		<td>
			{{ $value->valor }}
		</td>
		<td>
			<a href="{{ action('ContasPagarController@editar', $value->id) }}" title="" class="btn btn-small btn-info">Editar</a>
		</td>
		<td>
			<a href="#" onclick="apagar('{{ action('ContasPagarController@apagar', $value->id) }}')" title="" class="btn btn-small btn-danger">Apagar</a>
		</td>

	</tr>

@endforeach

</table>
@stop