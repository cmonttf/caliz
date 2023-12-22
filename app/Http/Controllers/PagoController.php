<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Person;
use App\Models\Cobro;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    public function index()
    {
        // Obtener todos los pagos y mostrarlos en una vista
        $pagos = Pago::all();
        $persons = Person::all();
        return view('pagos.index', compact('pagos', 'persons'));
    }

    public function create()
    {
        $persons = Person::all();
        return view('pagos.crear', compact('persons'));
    }

    public function store(Request $request)
    {
        // Validar y almacenar el nuevo pago
        $request->validate([
            'monto' => 'required|numeric',
            'fecha_pago' => 'required|date',
        ]);

        $data = $request->all();
        $data['status'] = 2; // Establecer el estado como 2

        Pago::create($data);
        return redirect()->route('pagos.index');
    }

    public function show(Pago $pago)
    {
        // Mostrar detalles de un pago específico
        $person = Person::find($pago->user_id);
        return view('pagos.show', compact('pago', 'person'));
    }

    public function edit(Pago $pago)
    {
        // Mostrar el formulario para editar un pago
        $person = Person::find($pago->user_id);
        return view('pagos.editar', compact('pago', 'person'));
    }

    public function update(Request $request, Pago $pago)
    {
        // Validar y actualizar el pago existente
        $request->validate([
            'monto' => 'required|numeric',
            'fecha_pago' => 'required|date',
        ]);

        $pago->update($request->all());

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado exitosamente.');
    }

    public function destroy(Pago $pago)
    {
        // Eliminar un pago
        $pago->delete();

        return redirect()->route('pagos.index')->with('success', 'Pago eliminado exitosamente.');
    }

    public function obtenerDatosGrafico() {

        $cobros = Cobro::all();
        //Pagados v/s Adeudados
        $pagados = 0;
        $adeudados = 0;
        $anio = date('Y');
        $mes = date('m');

        foreach ($cobros as $cobro) {
            if($anio == $cobro->anio && $mes == $cobro->mes){
                if($cobro->pagado == 1){
                    $pagados += $cobro->monto;
                }else{
                    $adeudados += $cobro->monto;
                }
            }
        }
        $labelsJson = ['Pagado', 'Adeudado'];
        $dataJson = [$pagados, $adeudados];

        return response()->json([
            'labels' => $labelsJson ,
            'data' => $dataJson,
        ]);
    }
}
