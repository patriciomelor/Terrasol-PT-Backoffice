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
<body class="login-page BackGradient" id="BackGradient">

<div id="app"class="login-box">
    <div class="card card-outline card-primary">
            @yield('content')     
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
