<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('asdf')
    <title>Foodstagram | Admin Panel</title>
    <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed" oncontextmenu="return false">
<div class="wrapper">

  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" id="side-bar">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Foodstagram</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
      <a href="{{ Auth::user()->image }}">
        <img src="{{ Auth::user()->image }}" class="img-circle elevation-2" alt="User Image">
      </a>
      </div>
      <div class="info">
        <a href="#" onclick="return alert('Hi , {{Auth::user()->name}} <3')" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                  <i class="fas fa-columns nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>

            <li class="nav-item">
              <a href="{{ route('users.index') }}" class="nav-link">
                <i class="fas fa-user-astronaut nav-icon"></i>
                <p>User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('categories.index') }}" class="nav-link">
                <i class="fas fa-stream nav-icon"></i>
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('foods.index') }}" class="nav-link">
                <i class="fas fa-hamburger nav-icon"></i>
                <p>Food</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('orders.index') }}" class="nav-link">
                <i class="fas fa-clipboard-list nav-icon"></i>
                <p>Order</p>&nbsp;&nbsp;<span class="badge bg-info">{{App\Order::where('state',0)->get()->count()}}</span>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="{{ route('orderfoods.index') }}" class="nav-link">
                <i class="fas fa-info nav-icon"></i>
                <p>Order-Detail</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="{{ route('customers.index') }}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Customer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('deliveries.index') }}" class="nav-link">
                <i class="fas fa-truck nav-icon"></i>
                <p>Delivery</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('deliverymens.index') }}" class="nav-link">
                <i class="fas fa-walking nav-icon"></i>
                <p>Deliveryman</p>
              </a>
            </li>
            <br>
            <form id="logout-form" action="{{ url('/logout') }}" method="post">
            @csrf
              <a class="btn btn-danger" id="logout_btn" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
            </form>
          <h6 style="font-size:11px;color:#869099;" class="text-center mt-4">Copyright &copy; 2021.All rights reserved.</h6>
        </ul>
    </nav>
  </div>
</aside>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <br>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-xxl-12 col-xl-12 col-12">
          <h1>@yield('title')</h1>
            @yield('content')
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
    <script src="{{asset('dist/js/demo.js')}}"></script>
    <script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
    <script src="{{asset('https://kit.fontawesome.com/68da0e5363.js')}}"></script>
    <script src="{{asset('js/style.js')}}"></script>  
    <script src="{{asset('https://code.highcharts.com/highcharts.js')}}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @stack('scripts')
    <script>
      $(document).ready(function(){
        setTimeout(function(){
           $("p.alert").remove();
        }, 4000 );
      })
    </script>
</body>
</html>