<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class WelcomeController extends Controller
{
    public function index(){
        $personas = Person::all();
        return view('welcome', compact('personas'));
    }

    public function show(Request $request){
        $id = $request->input('id');
        $persona = Person::find($id);
        return view('pagos', compact('persona'));
    }
}
