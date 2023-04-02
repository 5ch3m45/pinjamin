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
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="/assets/css/styles.css?v={{ time() }}" rel="stylesheet">
</head>

<body class="">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-ggrey" id="sidebar-wrapper">
            <a href="/">
                <div class="sidebar-heading bg-ggrey text-dark">
                    <img src="/assets/img/delivery.png" style="height: 24px" alt=""> STOK BARANG
                </div>
            </a>
            <div id="sidebar-menu" class="list-group list-group-flush p-3">
                {{-- <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2" href="/dashboard"><i class="bi bi-speedometer me-2"></i> Dashboard</a> --}}
                <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2" href="/dashboard/admin"><i class="bi bi-person-workspace me-2"></i> Admin</a>
                <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2" href="/dashboard/barang"><i class="bi bi-boxes me-2"></i> Barang</a>
                <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2" href="/dashboard/lokasi"><i class="bi bi-buildings-fill me-2"></i> Lokasi</a>
                <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2" href="/dashboard/pinjaman"><i class="bi bi-list-check me-2"></i> Pinjaman</a>
                <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2" href="/dashboard/user"><i class="bi bi-people-fill me-2"></i> User</a>
                <a class="list-group-item list-group-item-action list-group-item-light px-3 py-2 text-danger" href="/logout"><i class="bi bi-power me-2"></i> Logout</a>
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
                            <li class="nav-item active"><a class="nav-link" href="#!">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#!">Link</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#!">Action</a>
                                    <a class="dropdown-item" href="#!">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#!">Something else here</a>
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
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Core theme JS-->
    <script src="/assets/js/scripts.js?v={{ time() }}"></script>
</body>

</html>