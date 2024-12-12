<?php

namespace App\Http\Controllers;

use App\Convenios;
use App\Dentistas;
use App\Pacientes;
use App\PacientesConvenios;
use App\PacientesDentistas;
use App\PacientesEnderecos;
use App\PacientesObs;
use App\PacientesTelefones;
use Illuminate\Http\Request;

class pacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $pacientes;

    public function __construct(Pacientes $pacientes)
    {
        $this->middleware('auth');
        $this->pacientes = $pacientes;
    }

    public function index()
    {
        return view('pacientes.index');
    }

    public function listar($q = null)
    {
        $pacientes = $this->pacientes
        ->leftJoin('pacientes_enderecos', 'pacientes_enderecos.paciente_id', '=', 'pacientes.id')
        ->leftJoin('pacientes_obs', 'pacientes_obs.paciente_id', '=', 'pacientes.id')
        ->leftJoin('pacientes_dentistas', 'pacientes_dentistas.paciente_id', '=', 'pacientes.id')
        ->leftJoin('pacientes_convenios', 'pacientes_convenios.paciente_id', '=', 'pacientes.id')
        ->leftJoin('dentistas', 'pacientes_dentistas.dentista_id', '=', 'dentistas.id')
        ->select(
            'pacientes.id',
            'pacientes.ficha',
            'pacientes.nome',
            'pacientes.data_nasc',
            'pacientes.email',
            'pacientes.sexo',
            'pacientes.imagem',
            'pacientes_enderecos.id as enderecoId',
            'pacientes_enderecos.logradouro',
            'pacientes_enderecos.numero',
            'pacientes_enderecos.complemento',
            'pacientes_enderecos.bairro',
            'pacientes_enderecos.cidade',
            'pacientes_enderecos.uf',
            'pacientes_enderecos.cep',
            'pacientes_obs.obs',
            'dentistas.id as dentista_id',
            'dentistas.nome as dentista_nome'
        )->where('pacientes.nome', 'LIKE', '%'.$q.'%')
        ->orderBy('pacientes.ficha', 'desc')
        ->paginate(10);

        return $pacientes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $next_ficha = (Pacientes::max('ficha') + 1);
        $dentistas = Dentistas::all();
        $convenios = Convenios::all();

        return view('pacientes.create', compact('next_ficha', 'dentistas', 'convenios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //cria o paciente
        $paciente = new Pacientes();
        $paciente->ficha = $request->ficha;
        $paciente->nome = $request->nome;
        $paciente->data_nasc = $request->data_nasc;
        $paciente->email = $request->email;
        $paciente->sexo = $request->sexo;
        $paciente->imagem = $request->imagem ? $request->imagem : 'img/avatar.png';

        $paciente->save();
        //salva convenio
        dd($request->convenio);
        if ($request->convenio != null) {
            $convenio = new PacientesConvenios();
            $convenio->convenio_id = $request->convenio;
            $convenio->codigoAssociado = $request->codigoAssociado;
            $convenio->paciente_id = $paciente->id;
        }

        $convenio->save();

        if ($request->dentista != null) {
            $dentista = new PacientesDentistas();
            $dentista->paciente_id = $paciente->id;
            $dentista->dentista_id = $request->dentista;

            $dentista->save();
        }

        //salva os telefones
        if ($request->tipoTel) {
            foreach ($request->tipoTel as $id=>$val) {
                echo $id;
                $telefone = new PacientesTelefones();
                $telefone->paciente_id = $paciente->id;
                $telefone->telefone = $request->tel[$id];
                $telefone->tipo = $request->tipoTel[$id];
                $telefone->contato = $request->contato[$id];
                $telefone->save();
            }
        }

        //salva o endereço

        $endereco = new PacientesEnderecos();
        $endereco->paciente_id = $paciente->id;
        $endereco->cep = $request->cep;
        $endereco->logradouro = $request->logradouro;
        $endereco->numero = $request->numero;
        $endereco->complemento = $request->complemento;
        $endereco->bairro = $request->bairro;
        $endereco->cidade = $request->cidade;
        $endereco->uf = $request->uf;
        $endereco->save();

        //salva obs
        $obs = new PacientesObs();
        $obs->paciente_id = $paciente->id;
        $obs->obs = $request->obs;
        $obs->save();

        return redirect()->route('pacientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = $this->pacientes
        ->leftJoin('pacientes_enderecos', 'pacientes_enderecos.paciente_id', '=', 'pacientes.id')
        ->leftJoin('pacientes_obs', 'pacientes_obs.paciente_id', '=', 'pacientes.id')
        ->leftJoin('pacientes_dentistas', 'pacientes_dentistas.paciente_id', '=', 'pacientes.id')
        ->leftJoin('pacientes_convenios', 'pacientes_convenios.paciente_id', '=', 'pacientes.id')
        ->leftJoin('dentistas', 'pacientes_dentistas.dentista_id', '=', 'dentistas.id')
        ->leftJoin('convenios', 'pacientes_convenios.convenio_id', '=', 'convenios.id')
        ->select(
            'pacientes.id',
            'pacientes.ficha',
            'pacientes.nome',
            'pacientes.data_nasc',
            'pacientes.email',
            'pacientes.imagem',
            'pacientes.sexo',
            'pacientes_enderecos.id as enderecoId',
            'pacientes_enderecos.logradouro',
            'pacientes_enderecos.numero',
            'pacientes_enderecos.complemento',
            'pacientes_enderecos.bairro',
            'pacientes_enderecos.cidade',
            'pacientes_enderecos.uf',
            'pacientes_enderecos.cep',
            'pacientes_obs.obs',
            'convenios.id as convenio_id',
            'convenios.nome as convenio_nome',
            'pacientes_convenios.CodigoAssociado',
            'dentistas.id as dentista_id',
            'dentistas.nome as dentista_nome'
        )->find($id);
        $telefones = PacientesTelefones::where('paciente_id', $id)
                ->get();

        return view('pacientes.show')->with(compact('paciente', 'telefones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $dentistas = Dentistas::all();
        $convenios = Convenios::all();
        $paciente = $this->pacientes
        ->leftJoin('pacientes_enderecos', 'pacientes_enderecos.paciente_id', '=', 'pacientes.id')
        ->leftJoin('pacientes_obs', 'pacientes_obs.paciente_id', '=', 'pacientes.id')
        ->leftJoin('pacientes_dentistas', 'pacientes_dentistas.paciente_id', '=', 'pacientes.id')
        ->leftJoin('pacientes_convenios', 'pacientes_convenios.paciente_id', '=', 'pacientes.id')
        ->leftJoin('dentistas', 'pacientes_dentistas.dentista_id', '=', 'dentistas.id')
        ->leftJoin('convenios', 'pacientes_convenios.convenio_id', '=', 'convenios.id')
        ->select(
            'pacientes.id',
            'pacientes.ficha',
            'pacientes.nome',
            'pacientes.data_nasc',
            'pacientes.email',
            'pacientes.imagem',
            'pacientes.sexo',
            'pacientes_enderecos.id as enderecoId',
            'pacientes_enderecos.logradouro',
            'pacientes_enderecos.numero',
            'pacientes_enderecos.complemento',
            'pacientes_enderecos.bairro',
            'pacientes_enderecos.cidade',
            'pacientes_enderecos.uf',
            'pacientes_enderecos.cep',
            'pacientes_obs.obs',
            'convenios.id as convenio_id',
            'convenios.nome as convenio_nome',
            'pacientes_convenios.CodigoAssociado',
            'dentistas.id as dentista_id',
            'dentistas.nome as dentista_nome'
        )->find($id);
        $telefones = PacientesTelefones::where('paciente_id', $id)
                ->get();

        return view('pacientes.edit')->with(compact('paciente', 'telefones', 'convenios', 'dentistas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //cria o paciente
        $paciente = Pacientes::find($id);
        $paciente->ficha = $request->ficha;
        $paciente->nome = $request->nome;
        $paciente->data_nasc = $request->data_nasc;
        $paciente->email = $request->email;
        $paciente->sexo = $request->sexo;
        $paciente->imagem = $request->imagem ? $request->imagem : 'img/avatar.png';
        $paciente->save();

        //exclui convenios anteriores
        PacientesConvenios::where(['paciente_id'=>$id])->forceDelete();

        //salva convenio
        if ($request->convenio != null) {
            $convenio = new PacientesConvenios();
            $convenio->convenio_id = $request->convenio;
            $convenio->codigoAssociado = $request->codigoAssociado;
            $convenio->paciente_id = $paciente->id;

            $convenio->save();
        }

        //excluir dentistas
        PacientesDentistas::where(['paciente_id'=>$id])->forceDelete();
        //salva dentista
        if ($request->dentista != null) {
            $dentista = new PacientesDentistas();
            $dentista->paciente_id = $paciente->id;
            $dentista->dentista_id = $request->dentista;

            $dentista->save();
        }

        //exclui telefones
        PacientesTelefones::where(['paciente_id'=>$id])->forceDelete();

        //salva os telefones
        if ($request->tipoTel) {
            foreach ($request->tipoTel as $id_tel=>$val) {
                $telefone = new PacientesTelefones();
                $telefone->paciente_id = $id;
                $telefone->telefone = $request->tel[$id_tel];
                $telefone->tipo = $request->tipoTel[$id_tel];
                $telefone->contato = $request->contato[$id_tel];
                $telefone->save();
            }
        }

        //exclui endereços
        PacientesEnderecos::where(['paciente_id'=>$id])->forceDelete();
        //salva o endereço

        $endereco = new PacientesEnderecos();
        $endereco->paciente_id = $paciente->id;
        $endereco->cep = $request->cep;
        $endereco->logradouro = $request->logradouro;
        $endereco->numero = $request->numero;
        $endereco->complemento = $request->complemento;
        $endereco->bairro = $request->bairro;
        $endereco->cidade = $request->cidade;
        $endereco->uf = $request->uf;
        $endereco->save();

        //exclui obs
        PacientesObs::where(['paciente_id'=>$id])->forceDelete();
        //salva obs
        $obs = new PacientesObs();
        $obs->paciente_id = $paciente->id;
        $obs->obs = $request->obs;
        $obs->save();

        return redirect()->route('pacientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Pacientes::find($id)->delete();

        return redirect()->route('pacientes.index');
    }
}
