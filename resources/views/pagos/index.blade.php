@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Pagos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-pagos')
                            <a href="{{ route('pagos.create') }}" class="btn btn-warning">Nuevo Pago</a>
                            @endcan


                            @if(session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table id="myTable" class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                    <tr>
                                        <th style="color: #ffff;">ID</th>
                                        <th style="color: #ffff;">Nombre</th>
                                        <th style="color: #ffff;">Monto</th>
                                        <th style="color: #ffff;">Fecha de Pago</th>
                                        <th style="color: #ffff;">Gestor</th>
                                        <th style="color: #ffff;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pagos as $pago)
                                        <tr>
                                            @php
                                                foreach ($persons as $person) {
                                                    if ($pago->user_id == $person->id) {
                                                        $nombre = $person->nombres . ' ' . $person->apellidos;
                                                    }
                                                }

                                            @endphp
                                            <td>{{ $pago->id }}</td>
                                            <td>{{ $nombre }}</td>
                                            <td>${{ $pago->monto }}</td>
                                            <td>{{ $pago->fecha_pago }}</td>
                                            <td>{{ $pago->gestor }}</td>
                                            <td>

                                                @can('ver-pagos')
                                                <a href="{{ route('pagos.show', $pago->id) }}" class="btn btn-info">Ver</a>
                                                @endcan

                                                @can('editar-pagos')
                                                <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-warning">Editar</a>
                                                @endcan

                                                @can('borrar-pagos')
                                                <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este pago?')">Eliminar</button>
                                                </form>
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
