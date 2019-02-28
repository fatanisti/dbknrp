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
            <div class="card">
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
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ganti Password') }}
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
