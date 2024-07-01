<nav class="navbar navbar-expand-sm navbar-white bg-white">
    <div class="container">
        <a class="navbar-brand" href="{{ route('hotels.index') }}"><i class="fa-solid fa-building"></i></a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('hotels*') ? 'active' : '' }}" href="{{ route('hotels.index') }}">Hotéis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Usuários</a>
                </li>
            </ul>
            <div class="end-menu">
                <ul>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.show', auth()->user()->id) }}">
                            <div class="user-info">
                                <div class="user-credentials">
                                    <div class="username">
                                        {{ auth()->user()->name }}
                                    </div>
                                    <div class="email">
                                        {{ auth()->user()->email }}
                                    </div>
                                </div>
                                <div class="user-icon">
                                    {{ auth()->user()->name[0] }}
                                </div>
                            </div>

                        </a>
                    </li>

                    <li class="nav-item btn-exit">
                        <a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-right-from-bracket"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
