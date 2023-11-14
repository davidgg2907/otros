<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav @if(Auth::user()->darktheme == 0) navbar-light @else navbar-dark @endif navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
              <!--  <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email"><i class="ficon" data-feather="mail"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat"><i class="ficon" data-feather="message-square"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-calendar.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Calendar"><i class="ficon" data-feather="calendar"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Todo"><i class="ficon" data-feather="check-square"></i></a></li> -->
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item d-none d-lg-block">
              <a class="nav-link nav-link-style" onclick="lightDarkTheme()">
                @if(Auth::user()->darktheme == 1)
                  <i class="ficon" data-feather="sun" title="Activar Modo Light"></i>
                @else
                <i class="ficon" data-feather="moon" title="Activar Modo Dark"></i>
                @endif
              </a>
            </li>

            <li class="nav-item dropdown dropdown-notification mr-25">
              <a class="nav-link" href="javascript:void(0);" onclick="traeContactos();" data-toggle="dropdown">
                <i class="fa fa-comments fa-lg"></i><span id="iconChats" class="badge badge-pill badge-secondary badge-up">0</span>
              </a>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">{{ Auth::user()->name }}</span><span class="user-status">{{ Auth::user()->perfil }}</span></div><span class="avatar"><img class="round" src="{{ asset('/') }}images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                  <a class="dropdown-item" href="#"><i class="me-50" data-feather="user"></i> Mi Perfil</a>
                    <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ url('logout') }}"><i class="me-50" data-feather="power"></i> Cerrar Sesion</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
