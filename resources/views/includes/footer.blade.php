
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        {{ Auth::user()->name }}
    </div>
    <!-- Default to the left -->
    <strong> &copy; Copyright {{ current_year() }} <a href="#">CsCloud</a>.</strong> Todos los derechos reservados.
</footer>