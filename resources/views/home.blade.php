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

        // Obtener los últimos 12 meses incluyendo el mes actual
        $mesesParaMostrar = collect([]);
        for ($i = 0; $i < 13; $i++) {
            $mesesParaMostrar->push(now()->subMonths(12 - $i)->format('Y-m'));
        }

        $mesesChart = [];
        $total = [];

        // Inicializar el array de totales con ceros para cada mes disponible
        foreach ($mesesParaMostrar as $mes) {
            $mesesChart[] = $mes;
            $total[$mes] = 0;
        }

        // Contar la cantidad de pagos para cada mes
        foreach ($cobros as $cobro) {
            $mesCobro = $cobro->created_at->format('Y-m');
            if (array_key_exists($mesCobro, $total)) {
                if ($cobro->pagado == 1) {
                    $total[$mesCobro] += $cobro->monto;
                }
            }
        }

        $mesesJson = json_encode(array_values($mesesChart));
        $pagosJson = json_encode(array_values($total));

        //Tipos de pagos

        $electronico = 0;
        $manual = 0;
        foreach ($pagos as $pago) {
            if($pago->metodo == 'Electrónico'){
                $electronico += $pago->monto;
            }else{
                if($pago->metodo == 'MANUAL'){
                    $manual += $pago->monto;
                }
            }
        }

        $elec = json_encode($electronico);
        $manu = json_encode($manual);

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
                            <div class="container">
                                <div class="row align-items-stretch">
                                    <div class="col-sm-4 form-group">
                                        <div class="card h-100" style="background-color: #78f759; color: white; padding: 10px;">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title text-center">Pagados v/s Adeudados</h5>
                                                <div class="flex-grow-1">
                                                    <canvas id="pagado" style="height: 100%;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 form-group">
                                        <div class="card h-100" style="background-color: #fda744; color: white; padding: 10px;">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title text-center">Cantidad por Montos</h5>
                                                <div class="flex-grow-1">
                                                    <canvas id="cantidad" style="height: 100%;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row d-flex">
                                    <div class="col-sm-8 form-group">
                                        <div class="card h-100" style="background-color: #e5f055; color: white; padding: 10px;">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title text-center">Pagos en el Tiempo</h5>
                                                <div class="flex-grow-1">
                                                    <canvas id="pagos_tiempo" style="height: 100%;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <div class="card h-100" style="background-color: #b163e6; color: white; padding: 10px;">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title text-center">Tipos de pago</h5>
                                                <div class="flex-grow-1">
                                                    <canvas id="tipos_pagos" style="height: 100%;"></canvas>
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
        const tiempo = document.querySelector('#pagos_tiempo');

        const meses = {!! $mesesJson !!};

        const datos = {{ $pagosJson }};

        new Chart(tiempo, {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Pagado',
                    data: datos,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                },
            }
        });

    </script>

<script>
    const tipos = document.getElementById('tipos_pagos');

    const tip = ['ELECTRONICO', 'MANUAL'];
    const datas = [{{ $elec }}, {{ $manu }}];

    console.log(datas);

    new Chart(tipos, {
        type: 'bar',
        data: {
            labels: tip,
            datasets: [{
                label: 'Cantidad',
                data: datas,
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

@endsection

