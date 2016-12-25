<!DOCTYPE html>
<html lang="en">
@include('includes.head')
<body>
    <div class="container">
        @include('includes.nav')
        @include('includes.messages')
        @yield('content')
    </div>
@include('includes.js')
</body>
</html>
