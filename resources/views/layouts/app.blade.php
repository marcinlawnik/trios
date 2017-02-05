<!DOCTYPE html>
<html lang="en">
@include('includes.head')
<body>
    <div class="container">
        @include('includes.messages')
        @yield('content')
    </div>
@include('includes.js')
@include('includes.footer')
</body>
</html>
