@extends('app')

@section('pageTitle', 'Info Admin')

@section('content')
<form action="/hapus_akun/{{ $admin->id }}" method="POST">
    @csrf
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-danger">
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Penghapusan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menghapus akun admin <b><i class="title"></i></b> secara permanen.</p>
                    @if ($admin->role == 4)
                    <p>Perlu diketahui bahwa menghapus <b>Fundraiser</b> akan <u>melepas donatur yang ada di bawahnya</u> dan memindahkan datanya ke <b>"Permohonan Donatur"</b>, untuk selanjutnya diklaim oleh fundraiser lainnya yang masih aktif.</p>
                    @endif
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
<form action="/reset_akun/{{ $admin->id }}" method="POST">
    @csrf
    <div class="modal fade" id="confirm-reset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Reset Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Anda akan mengganti password akun admin <b><i class="title"></i></b></p>
                    <p>Tetap lanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-light btn-rounded" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-inverse-warning btn-rounded btn-ok">Reset</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-md-2 col-2">
        <a href="{{ route('manage_acc') }}"><i class="fa fa-arrow-circle-o-left"></i></a>
    </div>
    <div class="col-md-10 col-10">
        <h4 class="text-primary text-center"><i class="fa fa-address-card-o"></i> @yield('pageTitle') | {{ $admin->nama }}</h4>
    </div>
</div>
<div class="card-body text-center">
    <div class="row">
        <div class="col-md-4"><h5>Nama Admin</h5></div>
        <div class="col-md-8">{{ $admin->nama }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Username</h5></div>
        <div class="col-md-8">{{ $admin->username }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Domisili</h5></div>
        <div class="col-md-8">{{ $admin->domisili }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>No. HP</h5></div>
        <div class="col-md-8">{{ $admin->no_hp }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Email</h5></div>
        <div class="col-md-8">{{ $admin->email }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Status</h5></div>
        @if ($admin->role == 1)
        <div class="col-md-8"><b>Admin Utama</b></div>
        @elseif ($admin->role == 2)
        <div class="col-md-8"><b>Admin Maker</b></div>
        @elseif ($admin->role == 3)
        <div class="col-md-8"><b>Admin Daerah</b></div>
        @else
        <div class="col-md-8"><b>Fundraiser</b></div>
        @endif
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Tanggal Registrasi</h5></div>
        <div class="col-md-8">{{ Date::parse($admin->created_at)->format('j F Y H:i:s') }}</div>
    </div><br>
    <div class="row justify-content-center">
        <div class="col-md-6 col-6">
            <a href="/reset_akun/{{ $admin->id }}" data-record-id="{{ $admin->id }}" data-record-title="{{ $admin->nama }}" data-toggle="modal" data-target="#confirm-reset" class="btn btn-rounded btn-inverse-warning">
                <i class="fa fa-key"></i> Reset Password
            </a>
            <a href="/hapus_akun/{{ $admin->id }}" data-record-id="{{ $admin->id }}" data-record-title="{{ $admin->nama }}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-rounded btn-inverse-danger">
                <i class="fa fa-trash-o"></i> Hapus Admin
            </a>
        </div>
    </div><br>
</div>

<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        var data = $(e.relatedTarget).data();
        $('.title', this).text(data.recordTitle);        
    });

    $('#confirm-reset').on('show.bs.modal', function(e) {
        var data = $(e.relatedTarget).data();
        $('.title', this).text(data.recordTitle);
    });
</script>

@endsection