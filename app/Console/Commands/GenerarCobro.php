<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Person;
use App\Models\Cobro;
use Carbon\Carbon;

class GenerarCobro extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cobros:generar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $personas = Person::get();

        foreach ($personas as $usuario) {
            // Verificar si el usuario ya tiene un cobro para el mes actual
            $cobro = Cobro::where('user_id', $usuario->id)
                ->where('mes', Carbon::now()->month)
                ->where('anio', Carbon::now()->year)
                ->first();

            if (!$cobro) {
                // Crear el registro del cobro para el mes actual
                $nuevoCobro = new Cobro();
                $nuevoCobro->mes = Carbon::now()->month;
                $nuevoCobro->anio = Carbon::now()->year;
                $nuevoCobro->monto = $usuario->monto; // Asignar el monto correspondiente
                $nuevoCobro->pagado = false;
                $nuevoCobro->user_id = $usuario->id;
                $nuevoCobro->save();
            }
        }
    }
}
