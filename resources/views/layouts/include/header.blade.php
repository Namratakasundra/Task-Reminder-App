<a href="" id="sidebarMenuOpen" class="burger-menu"><i data-feather="arrow-left"></i></a>
      <div class="navbar-brand">
        <a href="{{ route('tasks.index') }}" class="df-logo">Task<span>Reminder</span></a>
      </div><!-- navbar-brand -->
      <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
          <a href="{{ route('tasks.index') }}" class="df-logo">Task<span>Reminder</span></a>
          <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div><!-- navbar-menu-header -->
        <ul class="nav navbar-menu">

          <li class="nav-item active"><a href="{{ route('users.index') }}" class="nav-link"><i data-feather="box"></i> Users Table</a></li>
          <li class="nav-item active"><a href="{{ route('categories.index') }}" class="nav-link"><i data-feather="archive"></i> Categoires</a></li>
          <li class="nav-item active"><a href="{{ route('priorities.index') }}" class="nav-link"><i data-feather="box"></i> Priorities</a></li>
          <li class="nav-item active"><a href="{{ route('tasks.index') }}" class="nav-link"><i data-feather="archive"></i> Task Table</a></li>
        </ul>

        {{-- For login User --}}
        <ul class="nav navbar">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
          @endif
        </ul>
      </div><!-- nav-wrapper -->
     