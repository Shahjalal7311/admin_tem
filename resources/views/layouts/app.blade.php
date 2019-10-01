<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Admin Managment') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  @include('partials.stylesheet')
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- jQuery 3 -->
  <script src="{{ asset('admins/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('admins/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('admins/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    @if (Auth::check())
      <header class="main-header">
        @include('partials.header')
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
          @include('partials.asidebar')
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="#">admin</a>.</strong>All rights reserved.
      </footer>
    @else
      @yield('content')
    @endif
  </div>
  <!-- ./wrapper -->
  @include('partials.javascripts')
</body>
</html>
