<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | STOK BARANG</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/assets/img/delivery.png">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/vendors/viewerjs/viewer.min.css">
    <link href="/assets/css/styles.css?v={{ time() }}" rel="stylesheet">
    @yield('style')
</head>

<body class="">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-ggrey" id="sidebar-wrapper">
            <a href="/dashboard">
                <div class="sidebar-heading bg-ggrey text-dark">
                    <img src="/assets/img/delivery.png" style="height: 24px" alt=""> STOK BARANG
                </div>
            </a>
            <div id="sidebar-menu" class="list-group list-group-flush p-3">
                <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2" href="/"><i class="bi bi-house-door-fill me-2"></i> Home</a>
                <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2" href="/troli"><i class="bi bi-cart-fill me-2"></i> Troli Pinjaman ({{ count(session('troli') ?? []) }})</a>
                @if(auth()->check())
                <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2" href="/riwayat-pinjaman"><i class="bi bi-clock-history me-2"></i> Riwayat Pinjaman</a>
                <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2" href="/profile"><i class="bi bi-person-fill me-2"></i> Profile saya</a>
                <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2 text-danger" href="/logout"><i class="bi bi-power me-2"></i> Logout</a>
                @else
                <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2 text-primary" href="/login"><i class="bi bi-box-arrow-in-right me-2"></i> Login</a>
                @endif
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <span role="button" class="text-primary" id="sidebarToggle"><i class="bi bi-list"></i></span>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item active"><a class="nav-link" href="/"><i class="bi bi-house-door-fill"></i> Home</a></li>
                            @if(auth()->check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-bell-fill"></i> Notifikasi</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#"><em>Belum ada notifikasi</em></a>
                                </div>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-list"></i> Menu</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/riwayat-pinjaman"><i class="bi bi-cart-fill"></i> Troli Pinjaman ({{ count(session('troli') ?? []) }})</a>
                                    @if(auth()->check())
                                    <a class="dropdown-item" href="/profile"><i class="bi bi-person-fill"></i> Profile saya</a>
                                    <a class="dropdown-item" href="/riwayat-pinjaman"><i class="bi bi-clock-history"></i> Riwayat Pinjaman</a>
                                    <a class="dropdown-item" href="/keamanan"><i class="bi bi-key-fill"></i> Keamanan</a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    @if(auth()->check())
                                    <a class="dropdown-item text-danger" href="/logout"><i class="bi bi-power"></i> Logout</a>
                                    @else
                                    <a class="dropdown-item text-primary" href="/login"><i class="bi bi-power"></i> Logout</a>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="/assets/vendors/jquery@3.6.3/jquery.min.js"></script>
    <!-- Core theme JS-->
    <script src="/assets/vendors/viewerjs/viewer.min.js"></script>
    <script src="/assets/vendors/viewerjs/jquery-viewer.min.js"></script>
    <script src="/assets/js/user.js?v={{ time() }}"></script>
    @yield('script')
</body>

</html>