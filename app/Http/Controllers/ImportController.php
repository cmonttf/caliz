<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonImport;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->getRealPath();
        $data = Excel::import(new PersonImport, $path);

        return redirect()->route('persons.index')->with('success', 'Datos importados correctamente.');
    }

    public function showImportForm(){
        return view('import.import');
    }
}
