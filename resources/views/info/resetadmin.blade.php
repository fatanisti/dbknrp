@extends('app')

@section('pageTitle', 'Reset Password')

@section('content')
<div class="card">
    <h4 class="card-header bg-success text-white">RESET PASSWORD BERHASIL</h4>
    <div class="card-body">
        <p class="card-text">Mohon untuk mencatat <b>Password Baru</b> di bawah ini untuk diberikan kepada admin terkait.</p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Username : <b>{{ $request->username }}</b></li>
        <li class="list-group-item">Password : <b>{{ $request->password }}</b></li>
    </ul>
    <div class="card-footer bg-success">
        <a href="{{ route('manage_acc') }}" class="btn btn-primary btn-rounded card-link">Kembali</a>
    </div>
</div>
@endsection