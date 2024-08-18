<header>
    <nav class="navbar navbar-expand-lg pt-2 pb-2">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('image/ebook.png')}}" alt="Logo" style="width: 100%; height: 55px" />
            </a>
            <h2>E-Book</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('buku') ? 'active' : '' }}" href="{{ url('/buku') }}">Data Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pengembalian') ? 'active' : '' }}" href="{{ url('/buku/pengembalian') }}">list_pengembalian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('peminjaman') ? 'active' : '' }}" href="{{ url('/buku/peminjaman') }}">list_peminjaman</a>
                    </li>

                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('/profile')}}">Profile</a></li>

                            <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link navit" href="{{ url('/login') }}">Login</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

</header>