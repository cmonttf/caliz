<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\User;
use App\Models\Pago;
use App\Models\Cobro;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $personas = Person::all();
        $usuario = User::all();
        $cobros = Cobro::all();
        return view('home', compact('personas', 'usuario', 'cobros'));
    }

    public function show($id){
        $person = Person::find($id);

        return view('pagos', compact('person'));
    }
}
