<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">


</head>

<body style="background-color:rgb(228, 247, 244)">
    <div id="app">

        <div class="sidebar d-none d-md-block">
            <b class="d-block text-center text-white mb-3" style="font-size: 24px;">
                BEAUTY & CO STUDIO
            </b>
            <div style="border-bottom: 1px solid #FFFFFF; width: 90%; margin: 0 auto; margin-bottom: 10px"></div>
            <div class="menu px-2">
                <a href="{{ route('home')}}" class="submenu my-1 {{ request()->routeIs('home') ? 'btn-pink' : 'btn-outline-light'}}">
                    <i class="bi bi-house-door" style="font-size: 1.4rem"></i>
                    Beranda
                </a>
                @if(Auth::user()->role == 'admin')
                <a href="{{ route('user')}}" class="submenu my-1 {{ request()->routeIs('user') ? 'btn-pink' : 'btn-outline-light'}}">
                    <i class="bi bi-person-fill" style="font-size: 1.4rem;"></i>
                    User
                </a>
                @endif
                <a href="{{ route('custemer')}}" class="submenu my-1 {{ request()->routeIs('custemer') ? 'btn-pink' : 'btn-outline-light'}}">
                    <i class="bi bi-person-badge" style="font-size: 1.4rem;"></i>
                    Customer
                </a>
                @if(Auth::user()->role == 'admin')
                <a href="{{ route('treatment')}}" class="submenu my-1 {{ request()->routeIs('treatment') ? 'btn-pink' : 'btn-outline-light'}}">
                    <i class="bi bi-intersect" style="font-size: 1.4rem;"></i> Treatment
                </a>
                @endif
                <a href="{{ route('transaksi')}}" class="submenu my-1 {{ request()->routeIs('transaksi') ? 'btn-pink' : 'btn-outline-light'}}">
                    <i class="bi bi-pencil-square" style="font-size: 1.4rem;"></i> Transaksi
                </a>

                <a href="{{ route('laporan')}}" class="submenu my-1 {{ request()->routeIs('laporan') ? 'btn-pink' : 'btn-outline-light'}}">
                    <i class="bi bi-journals" style="font-size: 1.4rem;"></i>
                    Laporan
                </a>
                <a href="{{route('gaji')}}" class="submenu my-1 {{ request()->routeIs('gaji') ? 'btn-pink' : 'btn-outline-light'}}">
                    <i class="bi bi-wallet" style="font-size: 1.4rem;"></i>
                    Gaji
                </a>
                <a class="dropdown-item submenu my-1" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout').submit();">
                    <i class="bi bi-box-arrow-right" style="font-size: 1.3rem;"></i> Logout
                </a>
                <form id="logout" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>


        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm d-flex align-items-center fixed-top">
            <div class="container-fluid">
                <button class="btn btn-secondary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                    ☰
                </button>

                <ul class="navbar-nav ms-auto" >
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="link nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @endif
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }} - {{Auth::user()->role}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <!-- Sidebar untuk HP (Menggunakan offcanvas) -->
        <div class="offcanvas offcanvas-sart d-md-none" id="mobileSidebar">
            <div class="offcanvas-header bg-secondary text-white">
                <h5 class="offcanvas-title">Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>

            <div class="offcanvas-body bg-secondary">
                <a href="{{ route('home')}}" class="btn d-block text-white my-1 {{ request()->routeIs('home') ? 'btn-primary' : 'btn-outline-light'}}">
                    Beranda
                </a>
                @if(Auth::User()->role == 'admin')
                <a href="{{ route('user')}}" class="btn d-block text-white my-1 {{ request()->routeIs('user') ? 'btn-primary' : 'btn-outline-light'}}">User</a>
                @endif
                <a href="{{ route('custemer')}}" class="btn d-block text-white my-1 {{ request()->routeIs('custemer') ? 'btn-primary' : 'btn-outline-light'}}">Customer</a>
                @if(Auth::User()->role == 'admin')
                <a href="{{ route('treatment')}}" class="btn d-block text-white my-1 {{ request()->routeIs('treatment') ? 'btn-primary' : 'btn-outline-light'}}">Treatment</a>
                @endif
                <a href="{{ route('transaksi')}}" class="btn d-block text-white my-1 {{ request()->routeIs('transaksi') ? 'btn-primary' : 'btn-outline-light'}}">Transaksi</a>
                <a href="{{ route('laporan')}}" class="btn d-block text-white my-1 {{ request()->routeIs('laporan') ? 'btn-primary' : 'btn-outline-light'}}">Laporan</a>
                <a href="{{ route('gaji')}}" class="btn d-block text-white my-1 {{ request()->routeIs('gaji') ? 'btn-primary' : 'btn-outline-light'}}">Gaji</a>
                <a class="btn d-block text-white my-1 btn-outline-light" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout').submit();">
                    Logout
                </a>
                <form id="logout" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="content">
            <main class="py-4">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>


</html>