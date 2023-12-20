@extends('pagos')

@section('content')

<section class="section">
    <div class="section-header">
        @php
            $total = 0;
        @endphp
        @foreach ($cobros as $co)
            @php
                $total += $co->monto;
            @endphp
        @endforeach
        <h3 class="page__heading">{{ $total > 0 ? 'Pagos' : 'Sin deudas' }}</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('/api/iniciar_compra') }}" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_id">ID de Usuario:</label>
                                        <input id="user_id" name="user_id" type="text" class="form-control" value="{{ $persona->id }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $persona->nombres . ' ' . $persona->apellidos }}" readonly>
                                    </div>
                                </div>
                            </div>
                            @foreach ($cobros as $cobro)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mes">Mes:</label>
                                            <input id="mes" name="mes" type="text" class="form-control" value="{{ $cobro->mes ."/". $cobro->anio }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="monto">Monto:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input id="monto" name="monto" type="text" class="form-control" value="{{ $cobro->monto }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Total:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input name="total" type="text" class="form-control font-weight-bold" value="{{ $total }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6" {{ $total == 0 ? 'hidden' : ''  }}>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Pagar</button>
                                    </div>
                                </div>
                                <div class="{{ $total == 0 ? 'col-md-12' : 'col-md-6' }}">
                                    <div class="form-group">
                                        <a href="{{ url('/') }}" class="btn btn-secondary btn-block">Volver</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
