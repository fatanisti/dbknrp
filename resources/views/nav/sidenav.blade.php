<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #A0ECEC;">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img class="img-xs rounded-circle" src="{{ asset('images/pic-4.png') }}" alt="Profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ Auth::user()->profile->nama }}</p>
                        <div>
                            <small class="designation">
                        @if ( Auth::user()->role == 1 )
                            Admin Utama
                        @elseif ( Auth::user()->role == 2 )
                            Admin Maker
                        @elseif ( Auth::user()->role == 3 )
                            Admin Daerah
                        @else                    
                            Fundraiser
                        @endif
                            </small>
                        </div>
                    </div>
                </div>
                <h6><i class="fa fa-map-marker"></i> {{ Auth::user()->profile->domisili }}</h6>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="menu-icon fa fa-home"></i>
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
                <span class="menu-title">Profil & Riwayat Donatur</span>
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