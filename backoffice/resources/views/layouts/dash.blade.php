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
    <link href="{{ asset('css/adminlte.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

  </head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
   <!-- Navbar -->
   <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

  
    </ul>
  </nav>
  <!-- /.navbar -->
     <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text text-center font-weight-light"><b>TERRA<b>SOL</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="align-items: center;">
             <div class="image">
                 <ion-icon name="person-circle-outline"style="color:grey!important;font-size: 32px;"></ion-icon>
             </div>
            <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
            <div class="info ml-4">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="document.getElementById('logout-form').submit();">
                    <ion-icon name="log-out-outline" style="color:red!important;font-size: 32px;"></ion-icon>
                </a>
            </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div><div class="sidebar-search-results"><div class="list-group"><a href="#" class="list-group-item"><div class="search-title"><strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong></div><div class="search-path"></div></a></div></div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url ('/home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Escritorio
              </p>
            </a>
       
          </li>
          <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
              </p>
            </a>
       
          </li>
          <li class="nav-header">SITIO
          </li>
          <li class="nav-item">
            <a href="{{ route('articles.index') }}" class="nav-link">
              <i class="nav-icon far fa-pencil"></i>
              <p>
                Publicaciones
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
     
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    <div class="content-wrapper" style="min-height: 204px;">
        @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif

          @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif

            @yield('content')     
    </div>
</div>
<script>
    setTimeout(function() {
      let alert = document.querySelector('.alert');
      if (alert) {
          alert.classList.remove('show');
          alert.classList.add('hide');
      }
  }, 5000); // 5000 ms = 5 segundos

</script>

   <!-- Primero jQuery -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Luego Bootstrap JS Bundle -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    
    <!-- Luego AdminLTE -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>

    <!-- Finalmente DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


@yield('scripts')
</body>
</html>
