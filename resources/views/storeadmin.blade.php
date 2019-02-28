@extends('app')

@section('pageTitle', 'Akun Admin Baru')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">AKUN ADMIN BERHASIL DITAMBAHKAN</h5>
        <p class="card-text">Mohon untuk mencatat <b>Username</b> dan <b>Password</b> di bawah ini untuk diberikan kepada admin terkait.</p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Username : <b>{{ $request->username }}</b></li>
        <li class="list-group-item">Password : <b>{{ $request->password }}</b></li>
    </ul>
    <div class="card-body">
        <a href="{{ route('home') }}" class="card-link">Kembali</a>
    </div>
</div>
@endsection