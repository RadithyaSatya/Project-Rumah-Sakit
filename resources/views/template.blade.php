<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title', 'CRUD Data Dokter')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                RADITH
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/dktr">
                            <i class="bi bi-house-door-fill me-1"></i> Dokter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/ruangan">
                            <i class="bi bi-house-door-fill me-1"></i> Ruangan
                        </a>
                    </li>
                </ul>
                @auth
                <div class="dropdown">
                    <img src="{{ Auth::user()->path_poto? asset(Auth::user()->path_poto) : asset('images/defaultpp.jpg') }}"
                         alt="User Avatar"
                         class="avatar dropdown-toggle"
                         id="avatarDropdown"
                         height="40"
                         data-bs-toggle="dropdown"
                         aria-expanded="false">
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="avatarDropdown">
                        <li>
                            <a class="dropdown-item" href="/profile" >
                                Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/password/reset" >
                                Reset Password
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="{{ route('actionlogout') }}">
                                <i class="fa fa-power-off"></i> Log out
                            </a>
                        </li>
                    </ul>
                </div>
                @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
                @endauth
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
