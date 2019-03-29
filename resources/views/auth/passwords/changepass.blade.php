@extends('app')

@section('pageTitle', 'Ganti Password')

@section('content')
<div class="container-scroller">
    <br/>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (\Session::get('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-primary text-white text-center">
                <div class="card-header">{{ __('Ganti Password') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('store_pass') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="oldPass" class="col-md-4 col-form-label text-md-right">{{ __('Masukkan Password Lama') }}</label>
                            <div class="col-md-6">
                                <input id="oldPass" type="password" class="form-control" name="oldPass" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="newPass" class="col-md-4 col-form-label text-md-right">{{ __('Masukkan Password Baru') }}</label>
                            <div class="col-md-6">
                                <input id="newPass" type="password" class="form-control" name="newPass" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="newPass_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Password Baru') }}</label>
                            <div class="col-md-6">
                                <input id="newPass_confirmation" type="password" class="form-control" name="newPass_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-4">
                                <a href="{{ route('home') }}" class="btn btn-light btn-rounded btn-block">
                                    <i class="fa fa-times-circle"></i> {{ __('Batal') }}
                                </a>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-rounded btn-block">
                                    <i class="fa fa-check-circle"></i> {{ __('Ganti Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
