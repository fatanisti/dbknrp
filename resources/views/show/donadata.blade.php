@extends('app')

@section('pageTitle', 'Profil Donatur')

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
<form action="/hapus_donatur/{{ $donatur->id }}" method="POST">
    @csrf
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-danger">
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Penghapusan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menghapus data donatur <b>{{ $donatur->nama }}</b> beserta <b>RIWAYAT DONASINYA</b> secara permanen.</p>
                    <p>Tetap lanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-light btn-rounded" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-inverse-danger btn-rounded btn-ok">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-1 col-1">
                <a href="{{ route('dona_data') }}"><i class="fa fa-arrow-circle-o-left"></i></a>
            </div>
            <div class="col-md-10 col-10">
                <h4 class="text-primary text-center"><i class="fa fa-address-card-o"></i> @yield('pageTitle') | {{ $donatur->nama }}</h4>
            </div>
        </div>
    </div>
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-md-4"><h5>ID Donatur</h5></div>
            <div class="col-md-8"><i class="fa fa-barcode"></i> {{ $donatur->id }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Tanggal Registrasi</h5></div>
            <div class="col-md-8"><i class="fa fa-calendar"></i> {{ Date::parse($donatur->tgl_regis)->format('j F Y') }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Nama Lengkap</h5></div>
            <div class="col-md-8"><i class="fa fa-user-circle-o"></i> {{ $donatur->nama }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Tempat Lahir</h5></div>
            <div class="col-md-8"><i class="fa fa-star"></i> {{ $donatur->tempat_lahir }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Tanggal Lahir</h5></div>
            <div class="col-md-8"><i class="fa fa-calendar-o"></i> {{ Date::parse($donatur->tgl_lahir)->format('j F Y') }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Alamat Domisili</h5></div>
            <div class="col-md-8"><i class="fa fa-map-marker"></i> {{ $donatur->alamat }} RT{{ $donatur->rt }}/RW{{ $donatur->rw }} Kel. {{ $donatur->kelurahan }}, Kec. {{ $donatur->kecamatan }}, {{ $donatur->kota_kab }}, {{ $donatur->provinsi }}, {{ $donatur->negara }} {{ $donatur->kodepos }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Telepon/No. HP</h5></div>
            <div class="col-md-8"><i class="fa fa-phone"></i> {{ $donatur->no_telp }} / {{ $donatur->no_hp }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Email</h5></div>
            <div class="col-md-8"><i class="fa fa-envelope"></i> {{ $donatur->email }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Facebook</h5></div>
            <div class="col-md-8"><i class="fa fa-facebook-square"></i> {{ $donatur->akun_facebook }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Instagram</h5></div>
            <div class="col-md-8"><i class="fa fa-instagram"></i> {{ $donatur->akun_instagram }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Profesi</h5></div>
            <div class="col-md-8"><i class="fa fa-briefcase"></i> {{ $donatur->profesi }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Catatan</h5></div>
            <div class="col-md-8"><i class="fa fa-pencil"></i> {{ $donatur->catatan }}</div>
        </div><br>
        @if ( Auth::user()->role == 3 || Auth::user()->role == 4 )
        <div class="row justify-content-center">
            <div class="col-md-4 col-6"><a href="/ubah_donatur/{{ $donatur->id }}" class="btn btn-inverse-warning btn-rounded btn-block"><i class="fa fa-edit"></i> Sunting</a></div>
            <div class="col-md-4 col-6"><a href="#" data-record-id="{{ $donatur->id }}" data-record-title="{{ $donatur->nama }}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-inverse-danger btn-rounded btn-block"><i class="fa fa-trash-o"></i> Hapus</a></div>
        </div><br>
        @endif
    </div>
</div>
@endsection