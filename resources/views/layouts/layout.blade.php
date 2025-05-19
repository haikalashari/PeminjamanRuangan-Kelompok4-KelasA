<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/remixicon/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/simple-datatables/style.css') }}">

    <!-- Template Main CSS File -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Updated: Apr 20 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            @can('isAdmin')
                <a href="{{ route('admin.index') }}" class="logo d-flex align-items-center">
                    <span class="d-none d-lg-block">Admin Dashboard</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            @endcan
            @Auth
            @cannot('isAdmin')
                <a href="{{ route('home') }}" class="logo d-flex align-items-center w-100">
                    <span class="d-none d-lg-block"><h4>E-Room</h4></span>
                </a>
            @endcannot
            @endAuth
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            @guest
            @else
            <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                {{-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> --}}
                <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6>Hai, {{ Auth::user()->name }}</h6>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.show') }}">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                @cannot('isAdmin')
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('peminjaman.riwayat') }}">
                    <i class="bi bi-person"></i>
                    <span>Riwayat Peminjaman</span>
                    </a>
                </li>
                @endcannot
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    </a>
                </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

            </ul>
            @endguest
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    @can('isAdmin')
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
            <a class="nav-link {{ request() -> is('home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
            <a class="nav-link {{ request() -> is('ruangan*') ? '' : 'collapsed' }}" href="{{ route('ruangan.index') }}">
                <i class="bi bi-menu-button-wide"></i><span>Ruangan</span>
            </a>
            </li><!-- End Components Nav -->

            <li class="nav-item">
            <a class="nav-link {{ request() -> is('peminjaman*') ? '' : 'collapsed' }}" href="{{ route('peminjaman.index') }}">
                <i class="bi bi-journal-text"></i><span>Peminjaman</span>
            </a>
            </li><!-- End Forms Nav -->

            

            <li class="nav-item">
            <a class="nav-link {{ request() -> is('admin*') ? '' : 'collapsed' }}" href="{{ route('admin.index') }}">
                <i class="bi bi-person"></i>
                <span>Admin</span>
            </a>
            </li><!-- End Profile Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->
    
    <main id="main" class="main">
    @endcan

    @guest 
        <main id="main" class="main ms-auto">
    @endguest

    @Auth
    @cannot('isAdmin')
        <main id="main" class="main ms-auto">
    @endcannot
    @endAuth
    
        {{-- @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif --}}

        {{-- @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif --}}

        {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger d-flex flex-row justify-content-between" role="alert">
                <div class="d-flex flex-row">
                    <div class="me-2">
                    <i class="bi bi-exclamation-circle text-danger fs-5"></i>
                    </div>
                    <div class="text-start">
                    <h4>{{ $error }}</h4>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn-close m-1" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                </div>
            @endforeach
        @endif --}}

        @yield('content')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    {{-- <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer> --}}
    <!-- End Footer -->


    <!-- Vendor JS Files -->

    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tiny-slider/tiny-slider.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.querySelectorAll('.alert').forEach(function(alert) {
                    // Hanya alert selain alert-info yang akan hilang otomatis
                    if (!alert.classList.contains('alert-info')) {
                        alert.classList.add('fade');
                        alert.classList.remove('show');
                        setTimeout(function() {
                            alert.remove();
                        }, 500); // waktu transisi fade (0.5 detik)
                    }
                });
            }, 3000); // 3 detik
        });
    </script>

</body>
</html>