<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Pago;

class PersonController extends Controller
{
    function __construct(){
        $this->middleware('permission:ver-persona|crear-persona|editar-persona|borrar-persona', ['only' =>['index']]);
        $this->middleware('permission:crear-persona', ['only' =>['create','store']]);
        $this->middleware('permission:editar-persona', ['only' =>['edit','update']]);
        $this->middleware('permission:borrar-persona', ['only' =>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = Person::all();
        return view('persons.index', compact('persons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('persons.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'monto' => 'required',
            'medio_de_pago' => 'required'
        ]);

        Person::create($request->all());
        return redirect()->route('persons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person = Person::find($id);
        $pagos = Pago::where('user_id', $person->id)->orderBy('id', 'DESC')->get();
        return view('persons.show', compact('person', 'pagos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::find($id);
        return view('persons.editar', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'monto' => 'required',
            'medio_de_pago' => 'required'
        ]);
        $person->update($request->all());
        return redirect()->route('persons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Person::find($id)->delete();
        return redirect()->route('persons.index');
    }

}
