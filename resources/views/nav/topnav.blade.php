<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background-color: #A0ECEC;">
        <a class="navbar-brand brand-logo" href="{{ url('/') }}">
            <img src="{{ asset('icon/logo.png') }}" alt="logo" style="max-width: 50%; height: auto;" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
            <img src="{{ asset('icon/logo.png') }}" alt="logo" style="width: 70%; height: auto;"/>
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <a><i class="fa fa-calendar"></i> {{ Date::now()->format('j F Y') }}</a>
        <ul class="navbar-nav navbar-nav-right">
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false"></a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    @if ( Auth::user()->role != 4)
                    <a class="dropdown-item mt-3" href="{{ route('manage_acc') }}">
                        <i class="fa fa-cogs"></i> Kelola Akun
                    </a>
                    @endif
                    <a class="dropdown-item mt-3" href="{{ route('change_pass') }}">
                        <i class="fa fa-key"></i> Ganti Password
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> {{ __('Logout') }}
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
        @endauth
    </div>
</nav>