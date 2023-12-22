@extends('layouts.app')

@section('content')
    @php

        //Pagados v/s Adeudados
        $pagados = 0;
        $adeudados = 0;
        $anio = date('Y');
        $mes = date('m');

        foreach ($cobros as $cobro) {
            if($anio == $cobro->anio && $mes == $cobro->mes){
                if($cobro->pagado == 1){
                    $pagados += $cobro->monto;
                }else{
                    $adeudados += $cobro->monto;
                }
            }
        }

        //Cantidad por montos
        $montos = [];
        $totales = [];

        for ($i = 0; $i < count($cobros); $i++) {
            if ($anio == $cobros[$i]->anio && $mes == $cobros[$i]->mes) {
                $montos[] = $cobros[$i]->monto;
            }
        }

        $montosUnicos = array_unique($montos);
        sort($montosUnicos);

        // Inicializar el array de totales con ceros para cada monto único
        foreach ($montosUnicos as $monto) {
            $totales[$monto] = 0;
        }

        // Contar la cantidad de veces que aparece cada monto
        foreach ($montos as $monto) {
            $totales[$monto]++;
        }

        $labelsJson = json_encode(array_values($montosUnicos)); // Convertir a array indexado
        $dataJson = json_encode(array_values($totales)); // Convertir a array indexado


        // Linea del tiempo

        // Obtener los meses disponibles en los pagos
        $mesesDisponibles = $cobros->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m');
        })->unique();

        // Tomar los últimos 12 meses disponibles
        $mesesParaMostrar = $mesesDisponibles->take(-12)->reverse();

        $mesesChart = []; // Cambio de nombre de variable
        $total = [];

        // Inicializar el array de totales con ceros para cada mes disponible
        foreach ($mesesParaMostrar as $mes) {
            $mesesChart[] = $mes; // Cambio de nombre de variable
            $total[$mes] = 0;
        }

        // Contar la cantidad de pagos para cada mes
        foreach ($cobros as $cobro) {
            $mesCobro = $cobro->created_at->format('Y-m');
            if (!empty($mesCobro) && array_key_exists($mesCobro, $total)) {
                if ($cobro->pagado == 1) {
                    $total[$mesCobro] += $cobro->monto;
                }
            }
        }

        $meses = json_encode($mesesChart); // Actualización del nombre de la variable
        $data = json_encode(array_values($total));

    @endphp
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Panel de Control</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-center">Contenido</h3>
                            <div class="container mt-4">
                                <div class="row align-items-stretch">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="card h-100" style="background-color: #4ADE26; color: white; padding: 10px;">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title text-center">Pagados v/s Adeudados</h5>
                                                <div class="flex-grow-1">
                                                    <canvas id="pagado"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-8 col-sm-8 col-md-8">
                                        <div class="card h-100" style="background-color: #de8826; color: white; padding: 10px;">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title text-center">Cantidad por Montos</h5>
                                                <div class="flex-grow-1">
                                                    <canvas id="cantidad"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container mt-4">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="card" style="background-color: #2651de; color: white; padding: 10px;">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title text-center">Pagos en el Tiempo</h5>
                                                <div class="flex-grow-1">
                                                    <canvas id="pagos_tiempo"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Obtener el elemento canvas con el id 'pagado'
        const pagadoCanvas = document.getElementById('pagado');

        // Crear el gráfico pie con el elemento canvas
        const myPieChart = new Chart(pagadoCanvas, {
            type: 'pie',
            data: {
                // Datos iniciales del gráfico
                labels: ['Pagado', 'Adeudado'], // Etiquetas
                datasets: [{
                    label: '$',
                    data: [{{ $pagados }}, {{ $adeudados }}], // Datos
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 99, 132, 0.5)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                // Opciones del gráfico
                // ...
            }
        });

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

        actualizarGrafico();

    </script>

    <script>
        const cantidades = document.getElementById('cantidad');

        const labels = {{ $labelsJson }};
        const data = {{ $dataJson }};

        new Chart(cantidades, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad',
                    data: data,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        const tiempo = document.getElementById('pagos_tiempo');

        const labels = {{ $meses }};
        const data = {{ $data }};

        new Chart(tiempo, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pagado',
                    data: data,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            }
        });
    </script>
@endsection

