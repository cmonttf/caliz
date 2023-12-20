<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class SeederPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::beginTransaction();

        try {
            $permisos = [
                //roles
                'ver-rol',
                'crear-rol',
                'editar-rol',
                'borrar-rol',

                //personas
                'ver-persona',
                'crear-persona',
                'editar-persona',
                'borrar-persona',

                //usuarios
                'ver-usuario',
                'crear-usuario',
                'editar-usuario',
                'borrar-usuario',

                //importar
                'importar',

                //pagos
                'ver-pagos',
                'crear-pagos',
                'editar-pagos',
                'borrar-pagos',

                //cobros
                'ver-cobros',
                'crear-cobros',
                'editar-cobros',
                'borrar-cobros',
            ];

            foreach ($permisos as $permiso) {
                if (!Permission::where('name', $permiso)->exists()) {
                    Permission::create(['name' => $permiso]);
                }
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }
}

