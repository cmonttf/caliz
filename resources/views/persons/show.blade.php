@extends('layouts.app')

@section('content')
    <section class="section">
        @if ($person)
            <div class="section-header">
                <h3 class="page__heading">Ver {{ $person->nombres }}</h3>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title">Datos Personales</h1>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="nombres">Nombres:</label>
                                                    <input class="form-control" type="text" value="{{ $person->nombres }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="apellidos">Apellidos:</label>
                                                    <input class="form-control" type="text" value="{{ $person->apellidos }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="direccion">Direccion:</label>
                                                    <input class="form-control" type="text" value="{{ $person->direccion }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="telefono">Telefono:</label>
                                                    <input class="form-control" type="text" value="{{ $person->telefono }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="correo">Correo:</label>
                                                    <input class="form-control" type="text" value="{{ $person->correo }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="monto">Monto a pagar:</label>
                                                    <input class="form-control" type="text" value="${{ $person->monto }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Fecha y hora de ingreso:</label>
                                                    <input class="form-control" type="text" value="{{ $person->created_at }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Última actualización:</label>
                                                    <input class="form-control" type="text" value="{{ $person->updated_at }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        @can('crear-pagos')
                                            <a href="{{ route('pagos.create') }}" class="btn btn-warning">Nuevo Pago</a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title">Pagos</h1>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        @if (!$pagos->isEmpty())
                                            <table class="table table-striped mt-2">
                                                <thead style="background-color: #6777ef;">
                                                    <tr>
                                                        <th style="color: #ffff;">N°</th>
                                                        <th style="color: #ffff;">N° Orden de Pago</th>
                                                        <th style="color: #ffff;">Monto Pagado</th>
                                                        <th style="color: #ffff;">Fecha de Pago</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i=1;
                                                    @endphp
                                                    @foreach ($pagos as $p)
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>#{{$p->id}}</td>
                                                            <td>${{$p->monto}}</td>
                                                            <td>{{ $p->fecha_pago }}</td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <div class="alert alert-warning" role="alert">
                                                            No hay pagos por el momento!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <a href="javascript: history.go(-1)"><button type="button" class="btn btn-primary">Volver</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h3 style="color: white;">Persona no encontrada.</h3>
        @endif
    </section>
@endsection
