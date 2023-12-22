@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Perfil</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revisa los campos!</strong>
                                    @foreach ($errors->any() as $error)
                                        <span class="badge badge-danger">{{ $error }}</span>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('alert'))
                                <div class="alert alert-danger mt-3">
                                    {{ session('alert') }}
                                </div>
                            @endif

                            {!! Form::model($user, ['route' => ['profile.update', $user->id], 'method' => 'PATCH']) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Nombre:</label>
                                            {!! Form::text("name", $user->name, array("class"=> "form-control")) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-4 col-md-5">
                                        <div class="form-group">
                                            <label for="">Correo:</label>
                                            {!! Form::text("email", $user->email, array("class"=> "form-control")) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-4 col-md-5">
                                        <div class="form-group">
                                            <label for="">Contraseña actual:</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-4 col-md-5">
                                        <div class="form-group">
                                            <label for="">Nueva contraseña:</label>
                                            <input type="password" class="form-control" name="password1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-4 col-md-5">
                                        <div class="form-group">
                                            <label for="">Repita contraseña:</label>
                                            <input type="password" class="form-control" name="password2">
                                            <div id="password-match-message"></div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cuando se modifica el campo de contraseña nueva o repetir contraseña
            $('input[name="password1"], input[name="password2"]').keyup(function() {
                // Obtiene el valor de ambas contraseñas
                var password1 = $('input[name="password1"]').val();
                var password2 = $('input[name="password2"]').val();

                // Obtiene el elemento del mensaje de verificación
                var passwordMatchMessage = $('#password-match-message');

                // Comprueba si las contraseñas coinciden
                if (password1 !== '' && password2 !== '' && password1 === password2) {
                    // Si coinciden, muestra un mensaje de coincidencia o algún indicador visual
                    passwordMatchMessage.text('Las contraseñas coinciden').addClass('text-success').removeClass('text-danger');
                    $('input[name="password2"]').removeClass('is-invalid').addClass('is-valid');
                } else {
                    // Si las contraseñas no coinciden, muestra un mensaje de error o indicador visual
                    passwordMatchMessage.text('Las contraseñas no coinciden').addClass('text-danger').removeClass('text-success');
                    $('input[name="password2"]').removeClass('is-valid').addClass('is-invalid');
                }
            });
        });
    </script>


@endsection
