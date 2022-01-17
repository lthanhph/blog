<nav id="topbar" class="navbar navbar-expand-md bg-success navbar-dark text-light">
    <div class="container-fluid">
        <div class="h-100 d-flex align-items-center">
            <button class="hamburger-btn btn me-3 text-light"><i class="fas fa-bars fa-2x"></i></button>
            <a href="{{ route('home') }}" class="navbar-brand text-light">
                <i class="brand-logo fab fa-blogger fa-2x"></i>
                <h4 class="h4">Personal Blog</h4>
            </a>
        </div>
        <ul class="navbar-nav">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <input type="submit" value="Logout" class="nav-link text-light logout">
            </form>
        </ul>
    </div>
</nav>