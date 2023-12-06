<aside id="sidebar-wrapper" class="d-flex flex-column">
    <div class="sidebar-brand">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img class="navbar-brand-full app-header-logo" src="{{ asset('img/logo.png') }}" width="65" alt="Infyom Logo">
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text">
            <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="45px" alt=""/>
        </a>
    </div>
    <ul class="nav flex-column sidebar-menu">
        @include('layouts.menu')
    </ul>
</aside>
