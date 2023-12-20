@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Cobros</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-cobros')
                            <a class="btn btn-warning" href="{{ route('cobros.create') }}">Nuevo</a>
                            @endcan

                            @if(session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif


                            <table id="myTable" class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                    <th style="color: #ffff;">N° Cobro</th>
                                    <th style="color: #ffff;">Nombre</th>
                                    <th style="color: #ffff;">Mes</th>
                                    <th style="color: #ffff;">Año</th>
                                    <th style="color: #ffff;">Estado</th>
                                    <th style="color: #ffff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($cobros as $cobro)
                                        <tr>
                                            @php
                                                foreach ($personas as $persona) {
                                                    if($cobro->user_id == $persona->id){
                                                        $nombre = $persona->nombres . ' ' . $persona->apellidos;
                                                    }
                                                }

                                            @endphp
                                            <td style="display: none"></td>
                                            <td>{{ $cobro->id }}</td>
                                            <td>{{ $nombre }}</td>
                                            <td>{{ $cobro->mes }}</td>
                                            <td>{{ $cobro->anio }}</td>
                                            <td>{{ $cobro->pagado == 0 ? 'Adeuda' : 'Pagado' }}</td>
                                            <td>
                                                @can('ver-cobros')
                                                <a class="btn btn-success" href="{{ route('cobros.show', $cobro->id) }}">Ver</a>
                                                @endcan


                                                @can('borrar-cobros')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['cobros.destroy', $cobro->id], 'style' => 'display:inline']) !!}
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
