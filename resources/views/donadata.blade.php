@extends('app')

@section('pageTitle', 'Data Donatur')

@section('content')
<form action="/hapus_donatur/{{ $donatur->dona_id }}" method="POST">
    @csrf
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Penghapusan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menghapus data donatur <b><i class="title"></i></b> beserta <b>RIWAYAT DONASINYA</b> secara permanen.</p>
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
<div class="card-header"><h4><i class="fa fa-user-o"></i> {{ __('PROFIL DONATUR') }}</h4></div>
<div class="card-body">
    @if ( Auth::user()->role == 3 || Auth::user()->role == 4 )
    <div class="row justify-content-center">
        <div class="col-md-4 col-6"><a href="/ubah_donatur/{{ $donatur->dona_id }}" class="btn btn-warning" style="width: 100%;">Perbarui</a></div>
        <div class="col-md-4 col-6"><a href="/hapus_donatur/{{ $donatur->dona_id }}" data-record-id="{{ $donatur->dona_id }}" data-record-title="{{ $donatur->dona_nama }}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" style="width: 100%;">Hapus</a></div>
    </div><br>
    @endif
    <div class="row">
        <div class="col-md-4"><h5>ID Donatur: </h5></div>
        <div class="col-md-8">{{ $donatur->dona_id }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Tanggal Registrasi: </h5></div>
        <div class="col-md-8">{{ $donatur->dona_tgl_regis }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Nama Lengkap: </h5></div>
        <div class="col-md-8">{{ $donatur->dona_nama }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Tempat Lahir: </h5></div>
        <div class="col-md-8">{{ $donatur->dona_tempat_lahir }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Tanggal Lahir: </h5></div>
        <div class="col-md-8">{{ $donatur->dona_tgl_lahir }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Alamat Domisili: </h5></div>
        <div class="col-md-8">{{ $donatur->dona_alamat }} RT{{ $donatur->dona_rt }}/RW{{ $donatur->dona_rw }} Kel. {{ $donatur->dona_kelurahan }}, Kec. {{ $donatur->dona_kecamatan }}, {{ $donatur->dona_kota_kab }}, {{ $donatur->dona_provinsi }}, {{ $donatur->dona_negara }} {{ $donatur->dona_kodepos }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Telepon/No. HP: </h5></div>
        <div class="col-md-8">{{ $donatur->dona_no_telp }} / {{ $donatur->dona_no_hp }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Email: </h5></div>
        <div class="col-md-8">{{ $donatur->dona_email }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Facebook: </h5></div>
        <div class="col-md-8">{{ $donatur->dona_akun_facebook }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Instagram: </h5></div>
        <div class="col-md-8">{{ $donatur->dona_akun_instagram }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Profesi: </h5></div>
        <div class="col-md-8">{{ $donatur->dona_profesi }}</div>
    </div><br>
    <div class="row">
        <div class="col-md-4"><h5>Catatan: </h5></div>
        <div class="col-md-8">{{ $donatur->dona_catatan }}</div>
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