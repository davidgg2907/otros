<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
              <a class="navbar-brand" href="{{ url('/') }}">
              <span class="brand-logo">
                <img src="{{ asset('images/logo.png') }}" style="height:35px !important; width:100%;max-width:none;">
              </span>
              </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" navigation-header" style="margin-top:10px;">
            <span data-i18n="User Interface">&nbsp;&nbsp;</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
          </li>
          <li class=" nav-item">
            <a class="d-flex align-items-center" href="{{ url('/') }}">
              <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Escritorio</span></a>
          </li>

          <li class=" navigation-header" style="margin-top:10px;">
            <span data-i18n="User Interface">GASTOS</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
            <circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
          </li>'; 

          <li class="mb-2">
            <a href="{{ url('admin/factura/add') }}" class="d-flex align-items-center">
              <i class="fas fa-upload"></i>
              <span class="menu-item text-truncate" data-i18n="Input">Cargar XML</span>
            </a>
          </li>


          <li class=" mb-2">
            <a href="{{ url('admin/factura') }}" class="d-flex align-items-center">
              <i class="far fa-file-code"></i>
              <span class="menu-item text-truncate" data-i18n="Input">Comprobantes</span>
            </a>
          </li>



          <li class=" navigation-header" style="margin-top:10px;">
            <span data-i18n="User Interface">REPORTE</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
            <circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
          </li>

          <li class="mb-2">
            <a href="{{ url('admin/factura/general') }}" class="d-flex align-items-center">
              <i class="fas fa-pie-chart"></i>
              <span class="menu-item text-truncate" data-i18n="Input">General</span>
            </a>
          </li>

          <li class="mb-2">
            <a href="{{ url('admin/factura/detallado') }}" class="d-flex align-items-center">
              <i class="fas fa-list-ul"></i>
              <span class="menu-item text-truncate" data-i18n="Input">Detallado</span>
            </a>
          </li>
          
          <li class=" navigation-header" style="margin-top:10px;">
            <span data-i18n="User Interface">OTROS</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
            <circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
          </li>
           
          <li class="mb-2">
            <a href="{{ url('admin/users') }}" class="d-flex align-items-center">
              <i class="fas fa-users"></i>
              <span class="menu-item text-truncate" data-i18n="Input">Usuarios</span>
            </a>
          </li>

          <li class=" nav-item">
            <a class="d-flex align-items-center" href="{{ url('logout') }}">
              <i data-feather='log-out'></i>
              <span class="menu-title text-truncate" data-i18n="Dashboards">Cerrar Sesion</span>
            </a>
          </li>

        </ul>
    </div>
</div>
