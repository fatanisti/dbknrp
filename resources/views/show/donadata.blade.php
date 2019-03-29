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
<form action="/hapus_donatur/{{ $donatur->dona_id }}" method="POST">
    @csrf
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-danger">
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Penghapusan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menghapus data donatur <b>{{ $donatur->dona_nama }}</b> beserta <b>RIWAYAT DONASINYA</b> secara permanen.</p>
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
                <h4 class="text-primary text-center"><i class="fa fa-address-card-o"></i> @yield('pageTitle') | {{ $donatur->dona_nama }}</h4>
            </div>
        </div>
    </div>
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-md-4"><h5>ID Donatur</h5></div>
            <div class="col-md-8"><i class="fa fa-barcode"></i> {{ $donatur->dona_id }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Tanggal Registrasi</h5></div>
            <div class="col-md-8"><i class="fa fa-calendar"></i> {{ Date::parse($donatur->dona_tgl_regis)->format('j F Y') }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Nama Lengkap</h5></div>
            <div class="col-md-8"><i class="fa fa-user-circle-o"></i> {{ $donatur->dona_nama }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Tempat Lahir</h5></div>
            <div class="col-md-8"><i class="fa fa-star"></i> {{ $donatur->dona_tempat_lahir }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Tanggal Lahir</h5></div>
            <div class="col-md-8"><i class="fa fa-calendar-o"></i> {{ Date::parse($donatur->dona_tgl_lahir)->format('j F Y') }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Alamat Domisili</h5></div>
            <div class="col-md-8"><i class="fa fa-map-marker"></i> {{ $donatur->dona_alamat }} RT{{ $donatur->dona_rt }}/RW{{ $donatur->dona_rw }} Kel. {{ $donatur->dona_kelurahan }}, Kec. {{ $donatur->dona_kecamatan }}, {{ $donatur->dona_kota_kab }}, {{ $donatur->dona_provinsi }}, {{ $donatur->dona_negara }} {{ $donatur->dona_kodepos }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Telepon/No. HP</h5></div>
            <div class="col-md-8"><i class="fa fa-phone"></i> {{ $donatur->dona_no_telp }} / {{ $donatur->dona_no_hp }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Email</h5></div>
            <div class="col-md-8"><i class="fa fa-envelope"></i> {{ $donatur->dona_email }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Facebook</h5></div>
            <div class="col-md-8"><i class="fa fa-facebook-square"></i> {{ $donatur->dona_akun_facebook }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Instagram</h5></div>
            <div class="col-md-8"><i class="fa fa-instagram"></i> {{ $donatur->dona_akun_instagram }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Profesi</h5></div>
            <div class="col-md-8"><i class="fa fa-briefcase"></i> {{ $donatur->dona_profesi }}</div>
        </div><br>
        <div class="row">
            <div class="col-md-4"><h5>Catatan</h5></div>
            <div class="col-md-8"><i class="fa fa-pencil"></i> {{ $donatur->dona_catatan }}</div>
        </div><br>
        @if ( Auth::user()->role == 3 || Auth::user()->role == 4 )
        <div class="row justify-content-center">
            <div class="col-md-4 col-6"><a href="/ubah_donatur/{{ $donatur->dona_id }}" class="btn btn-inverse-warning btn-rounded btn-block"><i class="fa fa-edit"></i> Sunting</a></div>
            <div class="col-md-4 col-6"><a href="#" data-record-id="{{ $donatur->dona_id }}" data-record-title="{{ $donatur->dona_nama }}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-inverse-danger btn-rounded btn-block"><i class="fa fa-trash-o"></i> Hapus</a></div>
        </div><br>
        @endif
    </div>
</div>
@endsection