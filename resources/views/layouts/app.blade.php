<!DOCTYPE html>
<html lang="en">
@include('includes.head')
<body>
    <div class="container">
        @include('includes.nav')
        @yield('content')
    </div>
@include('includes.js')
</body>
</html>
