<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Welcome Page :: {{ config('app.name') }}</title>

    <!-- Scripts V2 -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>

    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    
    <!-- Styles V2 -->
    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.jpg') }}">
</head>
<body background="https://era-m.us/media/2016/05/quds.jpg">
    <div class="row">
        <div class="col-12">
            <center><img src="{{ asset('icon/logo.png') }}" style="max-width: 100%; height: auto;" ></center>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-12">
            <h1 style="color: white;">Database Regional Jawa Barat</h1>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{{ route('login') }}">Masuk</a>
        </div>
    </div>
</body>
</html>
	