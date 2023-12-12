@extends('pagos')

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
                        <form action="{{ url('/api/iniciar_compra') }}" method="POST">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" readonly name="user_id" value="{{ $persona->id }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Nombre:</label>
                                        <input name="nombre" type="text" value="{{ $persona->nombres . ' ' . $persona->apellidos}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Monto:</label>
                                        $<input name="monto" type="text" value="{{ $persona->monto }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Pagar</button>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <a href="{{ url('/') }}">Volver</a>
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
