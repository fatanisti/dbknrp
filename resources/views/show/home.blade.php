@extends('app')

@section('pageTitle', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h4 class="text-primary text-center"><i class="fa fa-home"></i> @yield('pageTitle')</h4>
    </div>
    <br>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-cube text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Donasi Masuk (Rp)</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $monk }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-receipt text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Donasi Tercatat</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $riwa->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-poll-box text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Donatur Tetap</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $dona->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-account-location text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Fundraiser</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $fund->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection