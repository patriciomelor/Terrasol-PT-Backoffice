<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard - {{ config('app.name', 'Terrasol') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS AdminLTE -->
    {{-- <link href="{{ asset('css/adminlte.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/all.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('vendor/css/core.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <!-- Icons -->
    <link href="{{ asset('vendor/fonts/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fonts/tabler-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fonts/flag-icons.css') }}" rel="stylesheet">

    <!-- Core CSS -->
    <link href="{{ asset('vendor/css/rtl/core.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/rtl/theme-default.css') }}" rel="stylesheet">

    <link href="{{ asset('css/demo.css') }}" rel="stylesheet">

    <!-- Vendors CSS -->
    <link href="{{ asset('vendor/libs/node-waves/node-waves.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/typeahead-js/typeahead.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/apex-charts/apex-charts.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/swiper/swiper.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" rel="stylesheet">

    <!-- Page CSS -->
    <link href="{{ asset('vendor/css/pages/cards-advance.css') }}" rel="stylesheet">

    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>

    <!-- Config: Mandatory theme config file contain global vars & default theme options -->
    <script src="{{ asset('js/config.js') }}"></script>




  <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js">
    </script>


</head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                    fill="#7367F0" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                    fill="#7367F0" />
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold">TERRASOL</span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item active open">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div data-i18n="Dashboards">Dashboards</div>
                            <div class="badge bg-danger rounded-pill ms-auto">5</div>
                        </a>
                    </li>

                    <!-- Configuración de usuarios -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Config. Usuarios</span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('users.index') }}" class="menu-link">
                            <i class="menu-icon fas fa-user"></i>
                            <div data-i18n="Usuarios">Usuarios</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('roles.index') }}" class="menu-link">
                            <i class="menu-icon fas fa-lock"></i>
                            <div data-i18n="Roles">Roles</div>
                        </a>
                    </li>

                    <!-- Sitio -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">SITIO</span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('articles.index') }}" class="menu-link">
                            <i class="menu-icon far fa-edit"></i>
                            <div data-i18n="Publicaciones">Publicaciones</div>
                            <span class="badge badge-info right">2</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('characteristics.index') }}" class="menu-link">
                            <i class="menu-icon fa-regular fa-lightbulb"></i>
                            <div data-i18n="Servicios y Características">Servicios y Características</div>
                        </a>
                    </li>

                    <!-- Configuración de la Web -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Settings</span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('/settings') }}" class="menu-link">
                            <i class="menu-icon fa-solid fa-gear"></i>
                            <div data-i18n="Config. Web">Config. Web</div>
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="ti ti-menu-2 ti-md"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User Menu -->
                            <li class="nav-item dropdown user-menu">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <img src="../../dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2">
                                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                    <!-- User image -->
                                    <li class="user-header bg-primary">
                                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2">
                                        <p>{{ Auth::user()->name }} - {{ auth()->user()->role()->pluck('name')->implode(', ') }}</p>
                                    </li>
                                    <li class="user-body">
                                        <div class="row">
                                            @if (Auth::check())
                                            <div>
                                                Última vez conectado: {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('d M Y H:i') : 'Nunca' }}
                                            </div>
                                            @endif
                                        </div>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        @if (isset($currentUser))
                                        <a href="{{ route('users.edit', $currentUser) }}"
                                            class="btn btn-default btn-flat">Editar Perfil</a>
                                        @else
                                        <a href="{{ route('login') }}" class="btn btn-default btn-flat">Iniciar Sesión</a>
                                        @endif
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <a href="#" class="btn btn-default btn-flat float-right" onclick="document.getElementById('logout-form').submit();">
                                            <ion-icon name="log-out-outline" style="font-size: 16px;"></ion-icon> Salir
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

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
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Exito!</h5>
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        {{ session('error') }}
                    </div>
                    @endif

                    @yield('content')
                </div>
            </div>
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl">
                      <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                        <div class="text-body">
                          ©
                          <script>
                            document.write(new Date().getFullYear());
                          </script>
                          , &copy; Terrasol - Todos los derechos reservados.<a href="https://www.terrasol.cl" target="_blank" class="footer-link">TERRASOL</a>
                        </div>
                        <div class="d-none d-lg-inline-block">
                          <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank">License</a>
                          <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4">More Themes</a>
      
                          <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>
      
                          <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
                        </div>
                      </div>
                    </div>
                  </footer>
                <!-- Footer -->
            </div>
   

        </div>
    </div>

    <!-- JavaScript -->
<!-- Core JS -->
<script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('vendor/js/menu.js') }}"></script>

<!-- Vendors JS -->
<script src="{{ asset('vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('vendor/libs/swiper/swiper.js') }}"></script>
<script src="{{ asset('vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('js/dashboards-analytics.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=API_KEY&libraries=places"></script>
</body>

