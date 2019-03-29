@extends('app')

@section('pageTitle', 'Welcome')

@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one justify-content-center">
            <div class="row w-100">
                <div class="col-lg-6 mx-auto">
                    <div class="bg-light text-center" style="border-radius: 25px;">
                        <center><img src="{{ asset('icon/logo.png') }}" style="max-width: 100%; height: auto;" ></center>
                        <h1 class="text-primary"><b>Database Regional Jawa Barat</b></h1>
                        <br>
                    </div>
                    <br>
                    <a class="btn btn-primary btn-rounded btn-block" href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Masuk</a>
                    <br>
                    <a class="btn btn-success btn-rounded btn-block" href="{{ route('buat_dona') }}"><i class="fa fa-smile-o"></i> Jadi Donatur</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection