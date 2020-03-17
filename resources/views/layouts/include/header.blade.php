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
        <li class="nav-item active"><a href="{{ route('users.index') }}" class="nav-link"><i
                    data-feather="box"></i>Users</a></li>
        <li class="nav-item active"><a href="{{ route('categories.index') }}" class="nav-link"><i
                    data-feather="box"></i>Categoires</a></li>
        <li class="nav-item active"><a href="{{ route('priorities.index') }}" class="nav-link"><i
                    data-feather="box"></i>Priorities</a></li>
        <li class="nav-item active"><a href="{{ route('tasks.index') }}" class="nav-link"><i
                    data-feather="box"></i>Tasks</a></li>
    </ul>
</div><!-- nav-wrapper -->

<div class="navbar-right">
  <div class="dropdown dropdown-profile">
    <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
        <div class="avatar avatar-sm">
            @if(isset($user->profile_picture))
                 <img src="/storage/users/{{ Auth::user()->id }}/profile_picture/{{ Auth::user()->profile_picture}}" class="rounded-circle" alt="" style="border:5px;">
            @else
                <img src="/assets/img/blank_profile.png" class="rounded-circle" alt="">
            @endif
            {{-- @if(isset(Auth::user()->profile_picture) && (!Auth::user()->profile_picture))
                <img src="/storage/users/{{ Auth::user()->id }}/profile_picture/{{ Auth::user()->profile_picture}}" class="rounded-circle" alt="" style="border:5px;">
                @else
                @if(isset(Auth::user()->profile_picture))
                    <img src="/storage/users/{{ Auth::user()->id }}/profile_picture/{{ Auth::user()->profile_picture}}" class="rounded-circle" alt="" style="border:5px;">
                @else
                    <img src="/assets/img/blank_profile.png" class="rounded-circle" alt="">
                @endif
            @endif --}}
        </div>
    </a><!-- dropdown-link -->
    <div class="dropdown-menu dropdown-menu-right tx-13">
        <div class="avatar avatar-lg mg-b-15">
            @if(isset(Auth::user()->profile_picture))
                 <img src="/storage/users/{{ Auth::user()->id }}/profile_picture/{{ Auth::user()->profile_picture}}" class="rounded-circle" alt="" style="border:5px;">
            @else
                <img src="/assets/img/blank_profile.png" class="rounded-circle" alt="">
            @endif
        </div>
        <h6 class="tx-semibold mg-b-5">{{ Auth::user()->name }}</h6>
        <p class="mg-b-25 tx-12 tx-color-03">Administrator</p>
        <a href="{{route('users.show',['id'=>Auth::user()->id])}}" class="dropdown-item"><i data-feather="user"></i> View Profile</a>
        <a href="{{route('users.edit',['id'=>Auth::user()->id])}}" class="dropdown-item"><i data-feather="user"></i> Edit Profile</a>
        <a href="{{route('users.edit',['id'=>Auth::user()->id])}}" class="dropdown-item"><i data-feather="user"></i> Change Password</a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();"><i data-feather="log-out"></i>Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div><!-- dropdown-menu -->
</div><!-- dropdown -->
</div><!-- navbar-right -->