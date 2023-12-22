<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Person;
use App\Models\Cobro;

class PaymentsController extends Controller
{
    public function obtenerMonto($id)
    {
        try {
            // Obtener todos los cobros pendientes para el usuario dado
            $cobros = Cobro::where('user_id', $id)
                ->where('pagado', 0) // Ejemplo: Filtro para cobros pendientes
                ->get();

            // Calcular el monto total pendiente sumando los montos de los cobros
            $total = 0;
            foreach ($cobros as $item) {
                $total += $item->monto;
            }

            // Retornar los datos en formato JSON
            return response()->json([
                'monto_total_pendiente' => $total
            ]);
        } catch (\Exception $e) {
            // Loguear la excepción para depuración
            Log::error($e);

            return response()->json(['error' => 'Persona no encontrada'], 500);
        }
    }
}
