<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <form method="POST" action="{{ route('admin.logout') }}" id="logoutForm">
                    @csrf
                    <span onclick="document.getElementById('logoutForm').submit()">登出</span>
                </form>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
