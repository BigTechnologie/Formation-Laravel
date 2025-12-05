<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
            Projet Laravel
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('welcome') ? 'active fw-bold' : '' }}" href="{{ route('welcome') }}">
                        Home
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog.categories') ? 'active fw-bold' : '' }}" href="{{ route('blog.categories') }}">
                        Catégories
                    </a>
                </li>
            </ul>

            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('DELETE') 

                    <button class="btn btn-danger me-1">
                        Logout
                    </button>
                </form>
                @if(auth()->user()->roles && in_array('ROLE_ADMIN', json_decode(auth()->user()->roles)))
                    <a href="{{ route('admin.post.index') }}" class="btn btn-success">
                        Admin
                    </a>
                @endif
            @else

                    <a href="{{ route('login') }}" class="btn btn-warning me-1">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-success">Inscription</a>
            @endauth

        </div>
    </div>
</nav>
