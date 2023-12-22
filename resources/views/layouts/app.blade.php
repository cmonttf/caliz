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

<!-- jQuery -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<!-- DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>


<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
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
