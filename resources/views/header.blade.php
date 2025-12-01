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
                    <a class="nav-link {{ request()->routeIs('post.hello') ? 'active fw-bold' : '' }}" href="{{ route('post.hello') }}">
                        Hello
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('post.show') ? 'active fw-bold' : '' }}" href="{{ route('post.show', ['slug' => 'exemple', 'id' => 1]) }}">
                        Show (exemple)
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('post.data') ? 'active fw-bold' : '' }}" href="{{ route('post.data') }}">
                        Data
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('post.new') ? 'active fw-bold' : '' }}" href="{{ route('post.new') }}">
                        New
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
