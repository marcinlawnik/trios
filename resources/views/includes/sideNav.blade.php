<script type="text/javascript">
    /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
    function openNav() {
        $("#mySidenav").css('width', '250px');
        $('body').css('background-color', 'rgba(0,0,0,0.4)');
    }

    /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
    function closeNav() {
        $("#mySidenav").css('width', '0');
        $('body').css('background-color', 'white');
    }
</script>


<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="{{ url('/login') }}">Login</a>
    <a href="https://github.com/AKAI-TRIOS/trios">Source Code</a>
    <a href="https://www.facebook.com/akai.pp/">Contact</a>
</div>
<span class="glyphicon glyphicon-menu-hamburger" id="open-menu" onclick="openNav()"></span>