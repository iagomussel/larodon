<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dentistas;
use App\Consultas;
use App\Pacientes;

class ConsultasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        return view("consultas");
    }

    public function listar($q = null){

        $dentistas = Dentistas::all();
        $retorno = [];  
        $retorno["agendamentos"] = [];
        foreach($dentistas as $dentista){
          $agend = [];
          $agend["id"] = $dentista->id;
          $agend["nome"] = $dentista->nome;
          $agend["eventos"] = [ ];
          
          $retorno["agendamentos"][$dentista->id] = $agend;
        }
        $dia = $q?\DateTime::createFromFormat( 'd_m_Y', $q ):new \DateTime();
        $dia->setTime(0,0);//inicio do dia
        $dia_i = $dia->format('Y-m-d H:i:s');
        $dia->add(new \DateInterval("P1D"));
        $dia_f = $dia->format('Y-m-d H:i:s');
        
        // Your Eloquent query
        $consultas = Consultas::whereBetween("horario",[$dia_i,$dia_f])
        ->leftJoin("procedimentos","procedimentos.id","consultas.procedimento_id")
        ->select([
            'procedimentos.nome as procedimento_nome',
            'consultas.horario',
            'consultas.horario_termino',
            'consultas.paciente_nome',
            'consultas.paciente_id',
            'consultas.id',
            'consultas.dentista_id',
        ])
        ->get();
        
        //dd($consultas); 
        
        foreach($consultas as $consulta){
            $retorno["agendamentos"][$consulta->dentista_id]["eventos"][] = [
                "id" => $consulta->id,
                "horario" => $consulta->horario->format("H:i"),
                "horario_termino" => $consulta->horario_termino->format("H:i"),
                "paciente_nome"=>$consulta->paciente_nome,
                "paciente_id"=>$consulta->paciente_id,
                "procedimento_nome"=>$consulta->procedimento_nome,
            ];
        }
        return json_encode($retorno);
     
    }
    

    public function store(Request $request){
        


        $consulta = new Consultas();
        $dataehora = \DateTime::createFromFormat( 'd/m/Y', $request->dia );
        $timearray = explode(":",$request->hora);
        
        $dataehora->setTime($timearray[0],$timearray[1]);

        $consulta->horario = $dataehora->format( "Y-m-d H:i:s" );
        $dataehora->add(new \Dateinterval("PT30M"));
        $consulta->horario_termino = $dataehora->format( "Y-m-d H:i:s" );
        $consulta->dentista_id = $request->dentista;
        $consulta->status = "Agendado";
        
        //checar se o paciente ja existe
        $paciente = Pacientes::find($request->paciente_nome);
        if($paciente){
            $consulta->paciente_nome = $paciente->nome;
            $consulta->paciente_telefone = $request->paciente_telefone;
        } else {
            $consulta->paciente_nome = $request->paciente_nome;
            $consulta->paciente_telefone = $request->paciente_telefone;
        }
        
        $consulta->procedimento_id = $request->procedimento;
        $consulta->obsercacao = $request->obs;
        $paciente = Pacientes::where("pacientes.nome","=",$request->paciente_nome)->first();
       

        $consulta->save();
        return $consulta;

    }
}
