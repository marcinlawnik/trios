<!DOCTYPE html>
<html lang="en">
<head>
@include('includes.head')
@yield('head')
</head>
<body>
    <div class="container">
        @include('includes.messages')
        @yield('content')
        @include('includes.footer')
    </div>
@include('includes.js')
@stack('afterjs')
</body>
</html>
