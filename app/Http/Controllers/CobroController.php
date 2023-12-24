<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cobro;
use App\Models\Person;
use App\Models\Pago;

class CobroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cobros = Cobro::all();
        $personas = Person::all();

        return view('cobros.index', compact('cobros', 'personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas = Person::all();
        return view('cobros.crear', compact('personas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $c = Cobro::where('user_id', $request->user_id)->first();
        if($request->mes == $c->mes && $request->anio == $c->anio){
            return back()->withErrors(['No se puede agregar un cobro en el mismo mes y año que otro existente']);
        }else{
            $cobro = new Cobro();

            $cobro->mes = $request->mes;
            $cobro->anio = $request->anio;
            $cobro->monto = $request->monto;
            $cobro->user_id = $request->user_id;
            $cobro->save();

            return redirect()->route('cobros.index');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cobro = Cobro::find($id);
        $persona = Person::find($cobro->user_id);

        return view('cobros.show', compact('cobro', 'persona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cobro = Cobro::find($id);

        $cobro->delete();

        return redirect()->route('cobros.index');
    }
}
