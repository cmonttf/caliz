@extends('pagos')

@section('content')


<div class="container mt-4">
    <div class="jumbotron">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">Voucher de Pago</h1>
                            <p class="card-text">ID de Pago: {{ $pago->id }}</p>
                            <p class="card-text">Monto Pagado: ${{ number_format($pago->monto, 0) }}</p>
                            <p class="card-text">Fecha: {{ $pago->updated_at }}</p>
                            <p class="card-text">Estado de Pago: {{ $pago->status == 2 ? 'Exitoso' : 'Fallido' }}</p>
                            <a href="/" class="btn btn-primary">Ir a inicio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
