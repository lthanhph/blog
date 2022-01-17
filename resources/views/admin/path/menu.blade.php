<aside id="main-menu" class="navbar bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="{{ route('post.index') }}" class="nav-link text-light">
                <i class="fas fa-sticky-note"></i> Posts
            </a>
        </li>

        @if (auth()->user()->is_admin)
            <li class="nav-item">
                <a href="{{ route('term.index', ['tax_name' => 'category']) }}" class="nav-link text-light">
                    <i class="fas fa-layer-group"></i> Categories
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('term.index', ['tax_name' => 'tag']) }}" class="nav-link text-light">
                <i class="fas fa-tags"></i> Tags
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('comment.index') }}" class="nav-link text-light">
                    <i class="fas fa-comment"></i> Comments
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('menu.show-config') }}" class="nav-link text-light">
                    <i class="fas fa-bars"></i> Menus
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link text-light">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
        @endif
    </ul>
</aside>