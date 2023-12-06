@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Panel de Control</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Contenido</h3>
                            @php
                                $cantidad_personas=0;
                                foreach ($persona as $p) {
                                    $cantidad_personas++;
                                }
                                $cantidad_usuarios=0;
                                foreach ($usuario as $u) {
                                    $cantidad_usuarios++;
                                }

                                $monto=0;
                                foreach ($persona as $per) {
                                    $monto+=$per->monto;
                                }
                            @endphp

                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="card" style="background-color: #4ADE26; color: white; padding: 10px 10px 10px 10px;">
                                            <div class="card-title" style="text-align: center;">
                                                <span class="material-icons">group</span>
                                            </div>
                                            <div class="card-body">
                                                <p>Personas Inscritas: {{ $cantidad_personas }}</p>
                                                <p>Monto Ideal: ${{ $monto }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="card" style="background-color: #26b3de; color: white;">
                                            <div class="card-body">
                                                Usuarios Inscritos: {{ $cantidad_usuarios }}
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
@endsection

