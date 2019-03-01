<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') :: {{ config('app.name') }}</title>

    <!-- Scripts V2 -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>

    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    
    <!-- Styles V2 -->
    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">

    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.jpg') }}">
</head>
<body>
    <div class="container-scroller">
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ url('/') }}">
                    <img src="{{ asset('icon/logo.jpg') }}" alt="logo" style="max-width: 50%; height: auto;" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
                    <img src="{{ asset('icon/logo.jpg') }}" alt="logo"/>
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item">
                        <a><i class="mdi mdi-bookmark-plus-outline"></i>DBKNRP</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false"></a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            @if ( Auth::user()->role != 4)
                            <a class="dropdown-item mt-3" href="{{ route('manage_acc') }}">
                                Kelola Akun
                            </a>
                            @endif
                            <a class="dropdown-item mt-3" href="{{ route('change_pass') }}">
                                Ganti Password
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <div class="nav-link">
                            <div class="user-wrapper">
                                <div class="profile-image">
                                    <img class="img-xs rounded-circle" src="{{ asset('images/pic-4.png') }}" alt="Profile image">
                                </div>
                                <div class="text-wrapper">
                                    <p class="profile-name">{{ Auth::user()->nama }}</p>
                                    @if ( Auth::user()->role == 1 )
                                    <div>
                                        <small class="designation text-muted">Admin Utama</small>
                                    </div>
                                    @elseif ( Auth::user()->role == 2 )
                                    <div>
                                        <small class="designation text-muted">Admin Maker</small>
                                    </div>
                                    @elseif ( Auth::user()->role == 3 )
                                    <div>
                                        <small class="designation text-muted">Admin Daerah</small>
                                    </div>
                                    @else
                                    <div>
                                        <small class="designation text-muted">Fundraiser</small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <h6><i class="fa fa-map-marker"></i> {{ Auth::user()->domisili }}</h6>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="menu-icon fa fa-dashboard"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    @if ( Auth::user()->role == 2 || Auth::user()->role == 3 )
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create_lap') }}">
                            <i class="menu-icon mdi mdi-sticker"></i>
                            <span class="menu-title">Input Donasi Kegiatan</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dona_data') }}">
                            <i class="menu-icon fa fa-address-book-o"></i>
                            <span class="menu-title">Data Donatur</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dona_riwa') }}">
                            <i class="menu-icon mdi mdi-backup-restore"></i>
                            <span class="menu-title">Riwayat</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dona_laporan') }}">
                            <i class="menu-icon mdi mdi-chart-line"></i>
                            <span class="menu-title">Laporan</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <main class="mainBody">
                        @yield('content')
                    </main>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <footer class="footer">
                        <div class="container-fluid clearfix">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
                                <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved. Edited by Kaizen_Creative</span>
                            </span>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</body>
</html>