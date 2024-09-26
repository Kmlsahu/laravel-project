<!DOCTYPE html>
<html>
@include('includes.head')

<body class="skin-blue">
    <div class="wrapper">
        @include('includes.header')
        @include('includes.nav')
        <div class="content-wrapper">
            @yield('content')
        </div>

        @include('includes.footer')
        @yield('script')
    </div>
</body>

</html>