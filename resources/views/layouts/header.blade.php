<form class="d-flex mr-auto" action="#">
    <ul class="navbar-nav mr-3">
        <li class="nav-item">
            <a href="#" class="nav-link" id="toggleButton">
                <i class="material-icons">menu</i>
            </a>
        </li>
    </ul>
</form>
<ul class="navbar-nav ms-auto">
    @php
        $user = \Illuminate\Support\Facades\Auth::user();
    @endphp
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img alt="image" src="{{ asset('img/logo_blanco.png') }}" width="55"
                    class="rounded-circle me-1 thumbnail-rounded user-thumbnail ">
            <div class="d-sm-none d-lg-inline-block">
                Hola, {{$user->name}}
            </div>
        </a>
        @auth
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><h6 class="dropdown-header">Bienvenid@, {{$user->name}}</h6></li>
                <li><a class="dropdown-item" href="{{ route('profile.edit', $user->id) }}" data-id="{{ \Auth::id() }}">
                    <i class="material-icons">person</i>Editar Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="{{ url('logout') }}"
                   onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a></li>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                    {{ csrf_field() }}
                </form>
            </ul>
        @else
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><h6 class="dropdown-header">{{ __('messages.common.login') }}
                    / {{ __('messages.common.register') }}</h6></li>
                <li><a class="dropdown-item" href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i> {{ __('messages.common.login') }}
                </a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('register') }}">
                    <i class="fas fa-user-plus"></i> {{ __('messages.common.register') }}
                </a></li>
            </ul>
        @endauth
    </li>
</ul>
