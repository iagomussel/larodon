<?php

namespace App\Http\Controllers;

use App\Procedimentos;
use Illuminate\Http\Request;

class ProcedimentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('procedimentos.index');
    }

    public function listar($q = null)
    {
        return Procedimentos::where('nome', 'LIKE', '%'.$q.'%')
        ->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('procedimentos.create');
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
        //
        //dd($request);
        $proc = new Procedimentos();
        $proc->nome = $request->nome;
        $proc->descricao = $request->descricao;
        $proc->save();

        return redirect()->route('procedimentos.index');
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
        $procedimento = Procedimentos::find($id);

        return view('procedimentos.show')->with(compact('procedimento'));
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
        $proc = Procedimentos::find($id);
        $proc->nome = $request->nome;
        $proc->descricao = $request->descricao;
        $proc->save();

        return redirect()->route('procedimentos.index');
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
    }
}
