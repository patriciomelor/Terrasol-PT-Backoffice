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
        {{-- <link href="{{ asset('vendor/css/rtl/core.css') }}" rel="stylesheet"> --}}
        <link href="{{ asset('vendor/css/pages/page-auth.css') }}" rel="stylesheet">
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
    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="app-brand auth-cover-brand">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0"></path>
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616"></path>
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0"></path>
                </svg>
            </span>
            <span class="app-brand-text demo text-heading fw-bold">TERRASOL</span>
        </a>
        <!-- /Logo -->

        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-8 p-0">
              <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                  <img src="{{ asset('img/illustrations/auth-login-illustration-light.png') }}" alt="auth-login-cover" class="my-5 auth-illustration">
                    <img src="{{ asset('img/illustrations/bg-shape-image-light.png') }}" alt="auth-login-cover" class="platform-bg">            

                </div>
            </div>
            <!-- /Left Section (Illustration) -->
            @yield('content')     
        <!-- /Login Form -->
    </div>
</div>
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
</html>
