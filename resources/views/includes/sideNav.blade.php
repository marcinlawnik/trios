@push('afterjs')
<script type="text/javascript">
$(function() {
    /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
    $(".open-menu").on("click", function() {
        $("#mySidenav").addClass("open");
    });

    /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
    $(".close-menu").on("click", function() {
        $("#mySidenav").removeClass("open");
    });
});
</script>
@endpush

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="close-menu">&times;</a>
    <nav class="menu">
        @if(!Request::is('/'))
            <a href="{{ url('/') }}">Home</a>
        @endif
        @if(!Auth::check())
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
        @else
            <a href="{{ action('UserController@show', Auth::id()) }}">Your statistics</a>
            @if(Entrust::hasRole(['admin', 'mod']))
                <a href="{{ action('AdminController@index') }}">Admin panel</a>
            @endif
        @endif
        <a href="https://github.com/AKAI-TRIOS/trios">Source code</a>
        <a href="{{ url('/about') }}">About</a>
        <a href="https://www.facebook.com/akai.pp/">Contact</a>
        @if(Auth::check())
            <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();$('#logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endif
    </nav>
</div>
<div class="overlay close-menu"></div>
<a href="#" class="open-menu"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
