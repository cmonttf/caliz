@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Personas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-persona')
                            <a class="btn btn-warning" href="{{ route('persons.create') }}">Nuevo</a>
                            @endcan
                            @can('importar')
                            <a class="btn btn-success" href="{{ route('import.import.form') }}">Importar</a>
                            @endcan

                            <table id="miTabla" class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                    <th style="display:none; color: #ffff;">N°</th>
                                    <th style="color: #ffff;">Nombre</th>
                                    <th style="color: #ffff;">Apellido</th>
                                    <th style="color: #ffff;">Telefono</th>
                                    <th style="color: #ffff;">Monto</th>
                                    <th style="color: #ffff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($persons as $person)
                                        <tr>
                                            <td style="display: none"></td>
                                            <td>{{ $person->nombres }}</td>
                                            <td>{{ $person->apellidos }}</td>
                                            <td>{{ $person->telefono }}</td>
                                            <td>${{ $person->monto }}</td>
                                            <td>
                                                @can('ver-persona')
                                                <a class="btn btn-success" href="{{ route('persons.show', $person->id) }}">Ver</a>
                                                @endcan

                                                @can('editar-persona')
                                                <a class="btn btn-info" href="{{ route('persons.edit', $person->id) }}">Editar</a>
                                                @endcan


                                                @can('borrar-persona')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['persons.destroy', $person->id], 'style' => 'display:inline']) !!}
                                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
