<?php

namespace App\Http\Controllers;

use App\Dentistas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class dentistasController extends Controller
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
        return view('dentistas.index');
    }

    public function listar($q = null)
    {
        return Dentistas::where('nome', 'LIKE', '%'.$q.'%')
        ->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dentistas.create');
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
        $proc = new Dentistas();
        $user = new User();
        $user->username = $request->nome;
        $user->password = Hash::make($request->senha);
        $user->email = $request->email;
        $proc->nome = $request->nome;
        $proc->especializacao = $request->especializacao;

        $user->save();

        $proc->id_usuario = $user->id;

        $proc->save();

        return redirect()->route('dentistas.index');
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
        $dentista = Dentistas::find($id);

        return view('dentistas.show')->with(compact('dentista'));
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
        $proc = Dentistas::find($id);
        $proc->nome = $request->nome;
        $proc->especializacao = $request->especializacao;

        $proc->save();

        return redirect()->route('dentistas.index');
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
