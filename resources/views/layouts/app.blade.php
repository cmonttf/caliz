<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') | {{ config('app.name') }}</title>

<!-- Font Awesome CSS -->
<link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet">

<!-- Font Google Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<!-- IziToast CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">

<!-- SweetAlert CSS -->
<link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet">

<!-- Select2 CSS -->
<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- Custom DataTables CSS -->
<link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">

<!-- Google Fonts -->
<link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('web/css/components.css') }}">

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

<!-- DataTable -->
<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>


    <!-- Your Custom Scripts -->
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                "language": {
                    "decimal": ",",
                    "thousands": ".",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoPostFix": "",
                    "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
                    "loadingRecords": "Cargando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "searchPlaceholder": "Término de búsqueda",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "aria": {
                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    // solo funciona para los botones incorporados, no para los botones personalizados
                    "buttons": {
                        "create": "Nuevo",
                        "edit": "Cambiar",
                        "remove": "Borrar",
                        "copy": "Copiar",
                        "csv": "Fichero CSV",
                        "excel": "Tabla Excel",
                        "pdf": "Documento PDF",
                        "print": "Imprimir",
                        "colvis": "Visibilidad columnas",
                        "collection": "Colección",
                        "upload": "Seleccione fichero...."
                    },
                    "select": {
                        "rows": {
                            _: '%d filas seleccionadas',
                            0: 'clic fila para seleccionar',
                            1: 'una fila seleccionada'
                        }
                    }
                }
            });
        });

    </script>

@yield('page_css')
<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('web/css/components.css')}}">
@yield('page_css')

@yield('css')
</head>
<body>

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <!--Encabezado-->
        <nav class="navbar navbar-expand-lg main-navbar">
            @include('layouts.header')
        </nav>
        <!--Barra de menu-->
        <div class="main-sidebar main-sidebar-postion" id="sidebar-wrapper">
            @include('layouts.sidebar')
        </div>
        <!-- Main Content -->
        <div class="col-md-12 mx-auto col-9">
            <div class="main-content">
                @yield('content')
            </div>
        </div>
        <!--Pie de Pagina-->
        <footer class="main-footer" id="main-footer">
            @include('layouts.footer')
        </footer>
    </div>
</div>

@include('profile.change_password')
@include('profile.edit_profile')

</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

<!-- Template JS Files -->
<script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<script src="{{ mix('assets/js/profile.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
@yield('page_js')
@yield('scripts')
<script>
    let loggedInUser =@json(\Illuminate\Support\Facades\Auth::user());
    let loginUrl = '{{ route('login') }}';
    const userUrl = '{{url('users')}}';
    // Loading button plugin (removed from BS4)
    (function ($) {
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
    }(jQuery));

</script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
    $(document).ready(function() {
        var originalTexts = {};

        // Obtener los textos originales y guardarlos con sus respectivos IDs
        $("#sidebar-wrapper .nav-link").each(function(index) {
            var id = "originalText" + index;
            var originalText = $(this).find("span").text();
            originalTexts[id] = originalText;
            $(this).attr("data-original-text-id", id);
        });

        $("#toggleButton").on("click", function() {
            $("#sidebar-wrapper").toggleClass("collapsed");

            var isCollapsed = $("#sidebar-wrapper").hasClass("collapsed");

            $("#sidebar-wrapper .nav-link").each(function() {
                var originalTextID = $(this).attr("data-original-text-id");
                var newText = isCollapsed ? "" : originalTexts[originalTextID];
                $(this).find("span").text(newText);
            });

        });

        // Ocultar automáticamente el menú en dispositivos móviles
        function checkWindowSize() {
            if ($(window).width() < 992) { // Puedes ajustar este valor según sea necesario
                $("#sidebar-wrapper").addClass("collapsed");
                $("#sidebar-wrapper .nav-link").each(function() {
                    $(this).find("span").text("");
                });
            } else {
                $("#sidebar-wrapper").removeClass("collapsed");
                $("#sidebar-wrapper .nav-link").each(function() {
                    var originalTextID = $(this).attr("data-original-text-id");
                    var newText = originalTexts[originalTextID];
                    $(this).find("span").text(newText);
                });
            }
        }

        // Ajusta el ancho y alineación del pie de página
        if ($("#sidebar-wrapper").hasClass("collapsed")) {
                $(".main-footer").addClass("text-center");
            } else {
                $(".main-footer").removeClass("text-center");
            }

        // Verificar el tamaño de la ventana al cargar y redimensionar
        $(window).on("load resize", function() {
            checkWindowSize();
        });
    });
</script>

<style>
    /* Agrega una transición suave para el colapso del menú */
    .main-sidebar {
        transition: all 0.4s ease;
    }

    /* Define un ancho reducido para el menú colapsado */
    .main-sidebar.collapsed {
        width: 90px; /* Ancho deseado */
    }
</style>


</html>
