@extends('layouts.app')

@section('content')
    <section class="section">
        @if ($cobro)
            <div class="section-header">
                <h3 class="page__heading">Ver {{ $cobro->nombres }}</h3>
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
                                            <input class="form-control" type="text" value="{{ $cobro->id }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nombre:</label>
                                            <input class="form-control" type="text" value="{{ $persona->nombres . ' ' . $persona->apellidos }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Monto:</label>
                                            <input class="form-control" type="text" value="${{ $cobro->monto }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mes:</label>
                                            <input class="form-control" type="text" value="{{ $cobro->mes }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Año:</label>
                                            <input class="form-control" type="text" value="{{ $cobro->anio }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Estado:</label>
                                            <input class="form-control" type="text" value="{{ $cobro->pagado == 0 ? 'Adeuda' : 'Pagado' }}" readonly>
                                        </div>
                                        @foreach ($pago as $p)
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group" {{ $cobro->pagado == 0 ? 'hidden' : '' }}>
                                                        <label for="">N° de Pago:</label>
                                                        <input class="form-control" type="text" value="{{ $cobro->pagado == 0 ? '' : $p->id }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group" {{ $cobro->pagado == 0 ? 'hidden' : '' }}>
                                                        <label for="">Fecha de Pago:</label>
                                                        <input class="form-control" type="text" value="{{ $cobro->pagado == 0 ? '' : $p->updated_at }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="form-group">
                                            <label for="">Fecha de creación:</label>
                                            <input class="form-control" type="text" value="{{ $cobro->created_at }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Última actualización:</label>
                                            <input class="form-control" type="text" value="{{ $cobro->updated_at }}" readonly>
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
