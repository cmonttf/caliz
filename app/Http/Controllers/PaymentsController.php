<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Person;

class PaymentsController extends Controller
{
    public function obtenerMonto($id)
    {
        try {
            $person = Person::find($id);
            $monto = $person->monto;
            return response()->json(['monto' => $monto]);
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error($e);

            return response()->json(['error' => 'Persona no encontrada'], 500);
        }
    }
}
