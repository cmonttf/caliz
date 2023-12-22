@extends('pagos')

@section('content')


<div class="container mt-4">
    <div class="jumbotron">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">{{ $pago->status == 2 ? 'Voucher de Pago' : 'Pago Fallido' }}</h1>
                            <p class="card-text"><strong>ID de Pago:</strong> {{ $pago->id }}</p>
                            <p class="card-text"><strong>{{ $pago->status == 2 ? 'Monto Pagado:' : 'Monto' }} </strong> ${{ number_format($pago->monto, 0) }}</p>
                            <p class="card-text {{ $pago->status != 2 ? 'text-muted' : '' }}">
                                <strong>Fecha:</strong> {{ $pago->status == 2 ? $pago->updated_at : 'No disponible' }}
                            </p>
                            <p class="card-text"><strong>Estado de Pago:</strong> {{ $pago->status == 2 ? 'Exitoso' : 'Fallido' }}</p>
                            <form action="{{ url('/api/iniciar_compra') }}" method="POST">
                                <input type="text" hidden name="user_id" value="{{ $pago->user_id }}">
                                <input type="text" hidden name="total" value="{{ $pago->monto }}">
                                <input type="text" hidden name="id" value="{{ $pago->id }}">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <a href="/" class="btn btn-primary">Ir a inicio</a>
                                        </div>
                                        <div class="col">
                                            @if ($pago->status !== 2)
                                                <button class="btn btn-danger" type="submit">Pagar</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function actualizarGrafico() {
            fetch('/grafico/obtener-nuevos-datos') // Ruta hacia tu endpoint para obtener datos actualizados
                .then(response => response.json())
                .then(data => {
                    // Actualizar los datos del gráfico con los datos obtenidos
                    myPieChart.data.labels = data.labels;
                    myPieChart.data.datasets[0].data = data.data;
                    myPieChart.update();
                })
                .catch(error => {
                    console.error('Error al obtener los datos:', error);
                });
        }
    // Llamar a la función actualizarGrafico() cuando se efectúe un pago o evento relevante
    // Por ejemplo, podrías llamar a esta función después de realizar una acción de pago
    actualizarGrafico();
</script>

@endsection
