<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ContasPagar;
use Validator;

class ContasPagarController extends Controller
{
    
    public function listar()
    {
    	//$contas_pagar = DB::select('select * from contas_pagar');
    	$contas_pagar = ContasPagar::all();
    	return view('listar')->with('contas_pagar', $contas_pagar);
    }

    public function cadastro()
    {
    	return view('cadastro');
    }

    public function salvar(Request $request)
    {
    	$descricao = $request->input('descricao');
    	$valor = $request->input('valor');

    	$validator = Validator::make(
    	[
    		'descricao' => $descricao,
    		'valor' => $valor
    	],
    	[
    		'descricao' => 'required|min:6',
    		'valor' => 'required|numeric'
    	],
    	[
    		'required' => ':attribute é obrigatório.',
    		'numeric' => ':attribute precisa ser numérico.'
    	]
    	);

    	if ($validator->fails()) {
			return redirect()->action('ContasPagarController@cadastro')->withErrors($validator)->withInput(); 
    	}

    	//DB::insert('INSERT INTO contas_pagar (descricao, valor) VALUES (?, ?)', array($descricao, $valor));

    	$contas_pagar = new ContasPagar();
    	$contas_pagar->descricao = $descricao;
    	$contas_pagar->valor = $valor;
    	$contas_pagar->save();

    	return redirect()->action('ContasPagarController@listar')->withInput();
    }

    public function editar($id)
    {
    	$contas_pagar = ContasPagar::find($id);

    	if (empty($contas_pagar)) {
    		return 'Conta Pagar não existe!';
    	} else {	
    		return view('editar')->with('contas_pagar', $contas_pagar);
    	}
    }

    public function update(Request $request, $id)
    {
    	$descricao = $request->input('descricao');
    	$valor = $request->input('valor');
		
		$contas_pagar = ContasPagar::find($id);
		$contas_pagar->descricao = $descricao;
    	$contas_pagar->valor = $valor;
    	$contas_pagar->save();

    	return redirect()->action('ContasPagarController@listar')->withInput();
    }

    public function apagar($id)
    {
    	$contas_pagar = ContasPagar::find($id);
		$contas_pagar->delete();

    	return redirect()->action('ContasPagarController@listar');
    }
}
