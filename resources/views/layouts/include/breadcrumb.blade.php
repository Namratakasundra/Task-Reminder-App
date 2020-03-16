{{-- 
<nav aria-label="breadcrumb">
        <ol class="breadcrumb df-breadcrumbs mg-b-10">
                <li class="breadcrumb-item"><a href="layouts/admin">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/employees" aria-current="page">Employees</a></li>
                <li class="breadcrumb-item active" aria-current="page">Employee Table</li>
        </ol>
</nav> --}}

<div class="d-sm-flex align-items-center justify-content-between breadcrumbs">
        <div>
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="\home">Dashboard</a></li>
                <li class="breadcrumb-item active">@yield('breadcrumb-link')</li>
                {{-- <li class="breadcrumb-item active"><a href="" aria-current="page">@yield('breadcrumb-title')</a></li> --}}
                </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">@yield('breadcrumb-title')</h4>
        </div>
        <div class="d-none d-md-block">
        @yield('breadcrumb-btn')
        </div>
</div>