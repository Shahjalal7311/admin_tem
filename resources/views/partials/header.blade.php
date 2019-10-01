<!-- Logo -->
<a href="<?php url('/') ?>" class="logo" style="text-align: left;">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>AD</b></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>Admin</b></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{asset('img/post_dafult.jpg')}}" class="user-image" alt="User Image" height="160" width="160">
          <span class="hidden-xs">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="{{asset('img/post_dafult.jpg')}}" class="img-circle" alt="User Image" height="160" width="160">
            <p>
              {{ Auth::user()->name }}
              <small>{{ Auth::user()->created_at->toFormattedDateString() }}</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <i class="glyphicon glyphicon-log-out"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>