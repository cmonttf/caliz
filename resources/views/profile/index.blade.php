@extends('layouts.app')

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
                            @if(session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @php
                                $user = \Illuminate\Support\Facades\Auth::user();
                            @endphp

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Nombre:</label>
                                        {!! Form::text("name", $user->name, array("class"=> "form-control")) !!}
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-4 col-md-5">
                                    <div class="form-group">
                                        <label for="">Correo:</label>
                                        {!! Form::text("name", $user->email, array("class"=> "form-control")) !!}
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
