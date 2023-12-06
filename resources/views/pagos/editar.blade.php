@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Pagos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revisa los campos!</strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="badge badge-danger">{{ $error }}</span>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {!! Form::model($pago, ['method' => 'PATCH', 'route' => ['pagos.update', $pago->id]]) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Nombre:</label>
                                            {!! Form::text('', $person->nombres . ' ' . $person->apellidos, array('class' => 'form-control', 'readonly')) !!}
                                            {!! Form::text('user_id', $pago->user_id, array('class' => 'form-control', 'hidden')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="direccion">Monto:</label>
                                            {!! Form::text('monto', $pago->monto, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="telefono">Fecha de pago:</label>
                                            {!! Form::text('fecha_pago', $pago->fecha_pago, array('class' => 'form-control', 'readonly')) !!}
                                        </div>
                                    </div>


                                    {!! Form::text('metodo', $pago->metodo, array('class' => 'form-control', 'hidden')) !!}
                                    {!! Form::text('gestor', $pago->gestor, array('class' => 'form-control', 'hidden')) !!}


                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
