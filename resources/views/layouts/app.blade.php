<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'Toko Yusufnova')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home.index') }}"><i class="fa-solid fa-store"></i> Toko Yusufnova</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.index') }}"><i class="fa-solid fa-house-chimney"></i>
                            Home</a>
                    </li>
                    @if (Auth::check() && Auth::user()->role == 2)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.produk.index') }}"><i
                                    class="fa-solid fa-screwdriver-wrench"></i> Dashboard - Admin</a>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.show') }}"><i class="fa-solid fa-user"></i>
                            Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.logout') }}"><i
                                class="fa-solid fa-right-from-bracket"></i> Logout</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.formlogin') }}"><i class="fas fa-sign-in-alt"></i>
                                Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.formregister') }}"><i class="fas fa-user-plus"></i>
                                Register</a>
                        </li>
                    @else
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
