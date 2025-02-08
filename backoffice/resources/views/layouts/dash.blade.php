<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <!-- Encabezado Optimizado -->

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Dashboard - {{ config('app.name', 'Terrasol') }}</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com" />

<!-- Core CSS -->
<link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/css/core.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/css/theme-default.css') }}" rel="stylesheet">
<link href="{{ asset('css/demo.css') }}" rel="stylesheet">

<!-- Icons -->
<link href="{{ asset('vendor/fonts/fontawesome.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/fonts/tabler-icons.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/fonts/flag-icons.css') }}" rel="stylesheet">

<!-- CSS Adicional -->
<link href="{{ asset('css/node-waves.css') }}" rel="stylesheet">
<link href="{{ asset('css/perfect-scrollbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/apex-charts.css') }}" rel="stylesheet">
<link href="{{ asset('css/swiper.css') }}" rel="stylesheet">
<!-- Page CSS -->
<link href="{{ asset('css/cards-advance.css') }}" rel="stylesheet">
<!-- Cargar jQuery antes de Select2 -->
<!-- jQuery (primero) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <!-- Navbar -->
            <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                <div class="container-xxl">
                    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                        <a href="index.html" class="app-brand-link">
                            <span class="app-brand-logo demo">
                                <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                        fill="#7367F0"></path>
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                        fill="#161616"></path>
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                        fill="#161616"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                        fill="#7367F0"></path>
                                </svg>
                            </span>
                            <span class="app-brand-text demo menu-text fw-bold">TERRA<b>SOL</b></span>
                        </a>

                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                            <i class="ti ti-x ti-md align-middle"></i>
                        </a>
                    </div>

                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="ti ti-menu-2 ti-md"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Search -->
                            <li class="nav-item navbar-search-wrapper">
                                <a class="nav-link btn btn-text-secondary btn-icon rounded-pill search-toggler waves-effect waves-light"
                                    >
                                    <i class="ti ti-search ti-md"></i>
                                </a>
                            </li>
                            <!-- /Search -->



                            <!-- Style Switcher -->
                            <li class="nav-item dropdown-style-switcher dropdown">
                                <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light"
                                    href="#" data-bs-toggle="dropdown">
                                    <i class="ti ti-md ti-sun"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                                    <li>
                                        <a class="dropdown-item waves-effect active" 
                                            data-theme="light">
                                            <span class="align-middle"><i
                                                    class="ti ti-sun ti-md me-3"></i>Light</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item waves-effect" 
                                            data-theme="dark">
                                            <span class="align-middle"><i
                                                    class="ti ti-moon-stars ti-md me-3"></i>Dark</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <!-- / Style Switcher-->


                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('img/avatars/1.png') }}" alt=""
                                            class="rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item mt-0 waves-effect"
                                            href="pages-account-settings-account.html">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar avatar-online">
                                                        <img src="../../assets/img/avatars/1.png" alt=""
                                                            class="rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">John Doe</h6>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1 mx-n2"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item waves-effect" href="pages-profile-user.html">
                                            <i class="ti ti-user me-3 ti-md"></i><span class="align-middle">My
                                                Profile</span>
                                        </a>
                                    </li>
                                   

                                    <li>
                                        <div class="dropdown-divider my-1 mx-n2"></div>
                                    </li>

                                    <li>
                                        <div class="d-grid px-2 pt-2 pb-1">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger d-flex waves-effect waves-light">
                                                  <small class="align-middle">Cerrar sesion </small>
                                                  <i class="ti ti-logout ms-2 ti-14px"></i>
                                                </button>
                                              </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <aside id="layout-menu"
                        class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0"
                        data-bg-class="bg-menu-theme"
                        style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <div class="container-xxl d-flex text-center h-100">
                            <div class="menu-horizontal-wrapper">
                                <ul class="menu-inner pb-2 pb-xl-0" style="margin-left: 0px;justify-content: center;">
                                    <!-- Dashboards -->
                                    <li class="menu-item active open">
                                        <a href="{{route ('home')}}" class="menu-link menu-toggle">
                                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                                            <div data-i18n="Dashboards">Escritorio</div>
                                        </a>
                                    </li>

                   
                                    <li class="menu-item">
                                        <a href="{{ route('users.index') }}" class="menu-link">
                                            <i class="menu-icon fas fa-user"></i>
                                            <div data-i18n="Usuarios">Usuarios</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        @if(Route::has('roles.index'))
                                        <a href="{{ route('roles.index') }}" class="menu-link">
                                            <i class="menu-icon fas fa-lock"></i>
                                            <div data-i18n="Roles">Roles</div>
                                        </a>
                                        @endif

                                    </li>

                                    <!-- Sitio -->
                                    <li class="menu-header small text-uppercase">
                                        <span class="menu-header-text">SITIO</span>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('articles.index') }}" class="menu-link">
                                            <i class="menu-icon far fa-edit"></i>
                                            <div data-i18n="Publicaciones">Publicaciones</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('characteristics.index') }}" class="menu-link">
                                            <i class="menu-icon fa-regular fa-lightbulb"></i>
                                            <div data-i18n="Servicios y Características">Servicios y Características
                                            </div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('faqs.index') }}" class="menu-link">
                                            <i class="menu-icon fa-solid fa-quote-left"></i>
                                            <div data-i18n="F&QS">F&Q
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Configuración de la Web -->
                                    <li class="menu-header small text-uppercase">
                                        <span class="menu-header-text">Settings</span>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('settings.index') }}" class="menu-link">
                                            <i class="menu-icon fa-solid fa-gear"></i>
                                            <div data-i18n="Config. Web">Config. Web</div>
                                        </a>
                                    </li>
                                </ul>
                        </div>
                    </aside>
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Loader HTML -->
                        <div id="loader"
                            style="display:none; position: fixed; z-index: 1000; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Exito!</h5>
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                {{ session('error') }}
                            </div>
                        @endif
                        @yield('content')
                    </div>
                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>, &copy; Terrasol - Todos los derechos reservados.
                                    <a href="https://www.terrasol.cl" target="_blank"
                                        class="footer-link">TERRASOL</a>
                                </div>

                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!--/ Content wrapper -->
            </div>

            <!--/ Layout container -->
        </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
    <!-- JavaScript -->
  <!-- Scripts de Core -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module" src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/core.js') }}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/node-waves.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.js') }}"></script>

    <!-- JS Adicional -->
    <script src="{{ asset('js/swiper.js') }}"></script>

    <!-- Main JS y Configuración -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    function actualizarMenuActivo() {
        // Obtener la URL actual sin el parámetro de consulta
        var currentUrl = window.location.href.split(/[?#]/)[0];
    
        // Seleccionar todos los enlaces del menú
        var menuLinks = document.querySelectorAll('.menu-item a');
    
        // Eliminar la clase "active open" de todos los elementos del menú
        menuLinks.forEach(function(link) {
        link.closest('.menu-item').classList.remove('active', 'open');
        });
    
        // Recorrer todos los enlaces del menú
        menuLinks.forEach(function(link) {
        // Comprobar si la URL del enlace coincide con la URL actual
        if (link.href === currentUrl) {
            // Agregar la clase "active open" al padre del enlace
            link.closest('.menu-item').classList.add('active', 'open');
        }
        });
    }
    
    // Ejecutar la función al cargar la página
    document.addEventListener("DOMContentLoaded", actualizarMenuActivo);
    
    // Ejecutar la función cada vez que cambie la URL
    window.addEventListener('popstate', actualizarMenuActivo);
    });
    </script>

</body>
