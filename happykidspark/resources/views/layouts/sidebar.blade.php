<div class="main-menu menu-fixed @if(Auth::user()->darktheme == 0) menu-light @else menu-dark @endif menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
              <a class="navbar-brand" href="{{ url('/') }}">
              <span class="brand-logo">
                @if(\App\admin\Configuracion::getConfig()->logo != "")
                  <img src="{{ asset('uploads/empresa/' . \App\admin\Configuracion::getConfig()->logo) }}">
                @else
                  <img src="{{ asset('images/logo/logo.png') }}">
                @endif
              </span>
              <h2 class="brand-text" title="{{ \App\admin\Configuracion::getConfig()->nombre }}">{{ \App\admin\Configuracion::getConfig()->nombre }}</h2>
              </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item">
            <a class="d-flex align-items-center" href="{{ url('/') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Escritorio</span></a>
          </li>

          {!! \App\admin\Roles::imprimeMenu(Auth::user()->rol_id,'opr')!!}

          {!! \App\admin\Roles::imprimeMenu(Auth::user()->rol_id,'rpt')!!}

          {!! \App\admin\Roles::imprimeMenu(Auth::user()->rol_id,'cats')!!}

          {!! \App\admin\Roles::imprimeMenu(Auth::user()->rol_id,'conf')!!}

          {!! \App\admin\Roles::separador('otros')!!}
          <li class=" nav-item">
            <a class="d-flex align-items-center" href="{{ url('logout') }}">
              <i data-feather='log-out'></i>
              <span class="menu-title text-truncate" data-i18n="Dashboards">Cerrar Sesion</span>
            </a>
          </li>

        </ul>
    </div>
</div>
