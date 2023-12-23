<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class="material-icons">home</i><span>Inicio</span>
    </a>
    <a class="nav-link" href="/home">
        <i class="material-icons">dashboard</i><span>Panel de Control</span>
    </a>
    @can('ver-usuario')
        <a class="nav-link" href="/usuarios">
            <i class="material-icons">admin_panel_settings</i><span>Administración</span>
        </a>
    @endcan
    @can('ver-rol')
        <a class="nav-link" href="/roles">
            <i class="material-icons">supervisor_accounts</i><span>Roles</span>
        </a>
    @endcan
    @can('ver-persona')
        <a class="nav-link" href="/persons">
            <i class="material-icons">group</i><span>Personas</span>
        </a>
    @endcan
    @can('ver-pagos')
        <a class="nav-link" href="/pagos">
            <i class="material-icons">payments</i><span>Pagos</span>
        </a>
    @endcan
    @can('ver-cobros')
        <a class="nav-link" href="/cobros">
            <i class="material-icons">request_quote</i><span>Cobros</span>
        </a>
    @endcan
</li>
