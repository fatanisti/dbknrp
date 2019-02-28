@extends('app')

@section('pageTitle', 'Info Admin')

@section('content')
<form action="/hapus_akun/{{ $admin->id }}" method="POST">
    @csrf
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Penghapusan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menghapus akun admin <b><i class="title"></i></b> secara permanen.</p>
                    <p>Tetap lanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-danger btn-ok">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="card-header"><h4><i class="fa fa-user-o"></i> {{ __('INFO AKUN ADMIN') }}</h4></div>
<div class="card-body">
    <div class="row">
        <div class="col-md-4"><h5>Nama Admin</h5></div>
        <div class="col-md-8">: {{ $admin->nama }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Domisili</h5></div>
        <div class="col-md-8">: {{ $admin->domisili }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>No. HP</h5></div>
        <div class="col-md-8">: {{ $admin->no_hp }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Email</h5></div>
        <div class="col-md-8">: {{ $admin->email }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Status</h5></div>
        @if ($admin->role == 1)
        <div class="col-md-8"><b>: Admin Utama</b></div>
        @elseif ($admin->role == 2)
        <div class="col-md-8"><b>: Admin Maker</b></div>
        @elseif ($admin->role == 3)
        <div class="col-md-8"><b>: Admin Daerah</b></div>
        @else
        <div class="col-md-8"><b>: Fundraiser</b></div>
        @endif
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Tanggal Registrasi</h5></div>
        <div class="col-md-8">: {{ $admin->created_at }}</div>
    </div><br>
    <div class="row justify-content-center">
        <div class="col-md-6 col-12"><a href="/hapus_akun/{{ $admin->id }}" data-record-id="{{ $admin->id }}" data-record-title="{{ $admin->nama }}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" style="width: 100%;">Hapus Akun</a></div>
    </div><br>
</div>

<script>
    $('#confirm-delete').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        var id = $(this).data('recordId');
        $modalDiv.addClass('loading');
        setTimeout(function() {
            $modalDiv.modal('hide').removeClass('loading');
        }, 1000)
    });
    $('#confirm-delete').on('show.bs.modal', function(e) {
        var data = $(e.relatedTarget).data();
        $('.title', this).text(data.recordTitle);
        $('.btn-ok', this).data('recordId', data.recordId);
    });
</script>

@endsection