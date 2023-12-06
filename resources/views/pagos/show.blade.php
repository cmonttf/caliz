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
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">ID:</label>
                                            <input class="form-control" type="text" value="{{ $pago->id }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nombre:</label>
                                            <input class="form-control" type="text" value="{{ $person->nombres . ' ' . $person->apellidos }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Monto:</label>
                                            <input class="form-control" type="text" value="${{ $pago->monto }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Fecha de pago:</label>
                                            <input class="form-control" type="text" value="{{ $pago->fecha_pago }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Metodo:</label>
                                            <input class="form-control" type="text" value="{{ $pago->metodo }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gestor:</label>
                                            <input class="form-control" type="text" value="{{ $pago->gestor }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Fecha de ingreso:</label>
                                            <input class="form-control" type="text" value="{{ $pago->created_at }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Última actualización:</label>
                                            <input class="form-control" type="text" value="{{ $pago->updated_at }}" readonly>
                                        </div>

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
