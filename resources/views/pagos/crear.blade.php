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

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="montoInput" class="form-label">Total</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" class="form-control" name="monto" id="montoInput" placeholder="Enter total">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        {!! Form::date('fecha_pago', now(), array('class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <input type="text" hidden name="metodo" value="MANUAL">

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
            const guardarBtn = $('button[type="submit"]'); // Selección del botón de guardar

            // Función para deshabilitar o habilitar el botón según el valor del monto
            function toggleGuardarBtn() {
                const monto = parseFloat(montoInput.val());

                if (monto === 0 || isNaN(monto)) {
                    guardarBtn.prop('disabled', true); // Deshabilitar botón si el monto es 0 o no es un número
                } else {
                    guardarBtn.prop('disabled', false); // Habilitar botón si el monto es diferente de 0
                }
            }

            userSelect.on('change', function () {
                const selectedUserId = $(this).val();

                $.ajax({
                    url: '/obtener-monto/' + selectedUserId,
                    type: 'GET',
                    success: function (data) {
                        montoInput.val(data.monto_total_pendiente);
                        toggleGuardarBtn(); // Llamar a la función para comprobar el estado del botón
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
