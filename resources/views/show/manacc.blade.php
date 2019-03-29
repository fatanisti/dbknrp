@extends('app')

@section('pageTitle', 'Kelola Akun Admin')

@section('content')
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
<h4 class="text-primary text-center"><i class="fa fa-cogs"></i> @yield('pageTitle')</h4>
<div class="card-body text-center">
    @if ( Auth::user()->role != 4)
    <div class="row justify-content-center">
        <div class="col-md-12 col-12">
            <a href="{{ route('create_acc') }}" class="btn btn-inverse-success btn-rounded"><i class="fa fa-plus"></i>Buat Admin</a>
        </div>
    </div><br>
    @endif
    <div class="row table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($mamas as $adm)
                <tr class="table-light">
                    <td>{{ $adm->nama }}</td>
                    <td>{{ $adm->username }}</td>
                    @if ($adm->role == 1)
                    <td><b>Admin Utama</b></td>
                    @elseif ($adm->role == 2)
                    <td><b>Admin Maker</b></td>
                    @elseif ($adm->role == 3)
                    <td><b>Admin Daerah</b></td>
                    @else
                    <td><b>Fundraiser</b></td>
                    @endif
                    <td>
                        <a href="/info_akun/{{ $adm->id }}" class="btn btn-inverse-primary btn-rounded"><i class="fa fa-vcard-o"></i>Cek Akun</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        {{ $mamas->onEachSide(1)->links() }}
    </div>
</div>
@endsection