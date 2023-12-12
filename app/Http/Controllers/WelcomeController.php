<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Models\Cobro;

class WelcomeController extends Controller
{
    public function index(){
        $personas = Person::all();
        return view('welcome', compact('personas'));
    }

    public function show(Request $request){
        $id = $request->input('id');

        $cobros = Cobro::where('user_id', $id)->where('pagado', false)->get();

        $persona = Person::find($id);
        return view('transaccion.index', compact('persona', 'cobros'));
    }

}
