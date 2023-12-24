<?php

namespace App\Imports;

use App\Models\Person;
use Maatwebsite\Excel\Concerns\ToModel;

class PersonImport implements ToModel
{
    public function model(array $row)
    {
        return new Person([
            'nombres' => $row[0],
            'apellidos' => $row[1],
            'direccion' => $row[2],
            'telefono' => $row[3],
            'correo' => $row[4],
            'monto' => $row[5],
        ]);
    }
}
