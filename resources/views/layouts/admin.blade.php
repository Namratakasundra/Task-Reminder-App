<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.include.head')
   
</head>

<body>
    <header class="navbar navbar-header navbar-header-fixed">
        @include('layouts.include.header')
    </header><!-- navbar -->

    <div class="content content-fixed pd-20">
        <div class="container-fluid pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="mg-b-20 clearfix">
                <!-- breadcrumb-->
                @include('layouts.include.breadcrumb')
            </div>
            
            @yield('content')
        </div>
    </div>

    <!-- script -->
    @include('layouts.include.script')

    <!-- content-footer -->
    {{-- <footer class="content-footer">
        @include('layouts.include.footer')
    </footer> --}}

</body>

</html>
