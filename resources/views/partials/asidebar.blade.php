<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li>
        <a href="{{ route('dashboard') }}">
            <span class="text-info glyphicon glyphicon-user"></span> Dashboard
        </a>
    </li>
    @if (Auth::check())
        @can('view_posts')
            <li class="{{ Request::is('posts*') ? 'active' : '' }}">
                <a href="{{ route('posts.index') }}">
                    <span class="text-success glyphicon glyphicon-text-background">
                    </span> 
                    Posts
                </a>
            </li>
        @endcan
    @endif
    @if (Auth::check())
        @can('view_articals')
            <li class="{{ Request::is('articals*') ? 'active' : '' }}">
                <a href="{{ route('articals.index') }}">
                    <span class="text-success glyphicon glyphicon-text-background">
                    </span> 
                    Articals
                </a>
            </li>
        @endcan
    @endif
    @can('view_roles')
    <li class="{{ Request::is('roles*') ? 'active' : '' }}">
        <a href="{{ route('roles.index') }}">
            <span class="text-danger glyphicon glyphicon-lock"></span> Roles
        </a>
    </li>
    @endcan
    @can('view_users')
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}">
                <span class="text-info glyphicon glyphicon-user"></span> Users
            </a>
        </li>
    @endcan
    <!-- <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li> -->
    <li>
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            <i class="glyphicon glyphicon-log-out"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
   </li>
  </ul>
</section>