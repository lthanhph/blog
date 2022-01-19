<nav id="nav-menu" class="navbar navbar-expand-md bg-success navbar-dark">
    <div class="container-fluid">
        <a href="{{ route('home') }}" class="navbar-brand text-light">
            <i class="brand-logo fab fa-blogger fa-2x"></i>
            <h4 class="h4">Personal Blog</h4>
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#main-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navigation collapse navbar-collapse" id="main-menu">
            <ul class="navbar-nav">
                @if (!empty($menu))
                    @foreach ($menu->menuItem()->get() as $item)
                        <li class="nav-item mx-2">
                            <a href="{{ $item->url }}" class="nav-link text-light text-capitalize border-bottom">{{ $item->title }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                        <button id="user-dropdown" class="user-icon nav-link btn bg-transparent text-light dropdown-toogle px-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user-dropdown">
                            @if (!auth()->user()) 
                                <li><a href="{{ route('login') }}" class="dropdown-item">Login</a></li>
                                <li><a href="{{ route('register') }}" class="dropdown-item">Register</a></li>
                            @else
                                <li><a href="#" class="dropdown-item text-capitalize">{{ auth()->user()->name }}</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="{{ route('admin') }}" class="dropdown-item">Admin Dashboard</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post" class="logout dropdown-item">
                                        @csrf
                                        <button type="submit" class="btn bg-transparent p-0">Logout</button>
                                    </form>
                                </li>
                                
                            @endif
                        </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>