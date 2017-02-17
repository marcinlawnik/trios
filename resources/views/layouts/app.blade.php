<!DOCTYPE html>
<html lang="en">
@include('includes.head')
@yield('head')
<body>
    <div class="container">
        @include('includes.messages')
        @yield('content')
        @include('includes.footer')
    </div>
@include('includes.js')
</body>
</html>
