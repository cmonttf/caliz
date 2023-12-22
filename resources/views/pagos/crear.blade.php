@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear pago manual</h3>
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
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {!! Form::open(array('route' => 'pagos.store', 'method' => 'POST')) !!}
                            @csrf <!-- Agrega el token CSRF -->

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>Persona</label>
                                        <select name="user_id" class="form-control" id="userSelect">
                                            @foreach ($persons as $person)
                                                <option value="{{ $person->id }}">{{ $person->nombres . ' ' . $person->apellidos }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>Monto</label>
                                        <input type="text" class="form-control" name="monto" id="montoInput">
                                        <input type="hidden" name="monto_oculto" id="montoOculto">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        {!! Form::date('fecha_pago', now(), array('class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <input type="text" hidden name="metodo" value="WEB">

                                <input type="text" hidden name="gestor" value="{{ Auth::user()->name }}">
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

    <!-- Scripts al final del documento -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(function () {
            const userSelect = $('#userSelect');
            const montoInput = $('#montoInput');

            userSelect.on('change', function () {
                console.log('Cambio de usuario detectado.');

                const selectedUserId = $(this).val();
                console.log(selectedUserId);

                $.ajax({
                    url: '/obtener-monto/' + selectedUserId,
                    type: 'GET',
                    success: function (data) {
                        console.log('Success:', data);
                        montoInput.val(data.monto);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', xhr.responseText);
                        // Puedes mostrar un mensaje de error al usuario aquí
                    }
                });
            });
        });

        // Llamar a la función actualizarGrafico() cuando se efectúe un pago o evento relevante
        // Por ejemplo, podrías llamar a esta función después de realizar una acción de pago
        actualizarGrafico();
    </script>
@endsection
