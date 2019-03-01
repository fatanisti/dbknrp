@extends('app')

@section('pageTitle', 'Riwayat Donasi')

@section('content')
<form action="/simpan_riwayat/{{ $donatur->dona_id }}" method="POST">
    @csrf
    <div class="modal fade" id="confirm-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah Donasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12 col-12">
                            <label for="inputTgl">Tanggal Donasi</label>
                            <input type="date" class="form-control" id="inputTgl" name="inputTgl">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-12">
                            <label for="inputDona">Besaran Donasi</label>
                            <input type="number" class="form-control" id="inputDona" name="inputDona">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-12">
                            <label for="inputJenis">Jenis Donasi</label>
                            <select id="inputJenis" class="form-control" name="inputJenis">
                                <option value="Transfer">Transfer</option>
                                <option value="Cash">Cash</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-12">
                            <label for="inputBank">Bank</label>
                            <select id="inputBank" class="form-control" name="inputBank">                                
                                <option value="CIMB Syariah">CIMB Syariah</option>
                                <option value="Bank Syariah Mandiri">Bank Syariah Mandiri</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-success btn-ok">Tambah Donasi</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{ url()->current() }}" style="padding: 0px 0px 10px 0px;">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="daerah">Daerah</label>
            <input type="text" class="form-control" id="daerah" placeholder="{{ $donatur->dona_kota_kab }}" disabled>
        </div>
        <div class="form-group col-md-6">
            <label for="nama_dona">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_dona" placeholder="{{ $donatur->dona_nama }}" disabled>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="tahun">Tahun</label>
            <select id="tahun" class="form-control" name="keywordTahun">
                <option selected value="">--- Semua ---</option>
            @for ($i = 2018; $i<=2050; $i++)
                <option value="{{$i}}" {{ old('keywordTahun', $entry['keywordTahun'] )== $i ? 'selected' : ''  }}>{{$i}}</option>
            @endfor
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="bulan">Bulan</label>
            <select id="bulan" class="form-control" name="keywordBulan">
            <option value="">--- Semua ---</option>
            <option value="1" {{ old('keywordBulan', $entry['keywordBulan'] )== '1' ? 'selected' : ''  }}>01 - Januari</option>
            <option value="2" {{ old('keywordBulan', $entry['keywordBulan'] )== '2' ? 'selected' : ''  }}>02 - Februari</option>
            <option value="3" {{ old('keywordBulan', $entry['keywordBulan'] )== '3' ? 'selected' : ''  }}>03 - Maret</option>
            <option value="4" {{ old('keywordBulan', $entry['keywordBulan'] )== '4' ? 'selected' : ''  }}>04 - April</option>
            <option value="5" {{ old('keywordBulan', $entry['keywordBulan'] )== '5' ? 'selected' : ''  }}>05 - Mei</option>
            <option value="6" {{ old('keywordBulan', $entry['keywordBulan'] )== '6' ? 'selected' : ''  }}>06 - Juni</option>
            <option value="7" {{ old('keywordBulan', $entry['keywordBulan'] )== '7' ? 'selected' : ''  }}>07 - Juli</option>
            <option value="8" {{ old('keywordBulan', $entry['keywordBulan'] )== '8' ? 'selected' : ''  }}>08 - Agustus</option>
            <option value="9" {{ old('keywordBulan', $entry['keywordBulan'] )== '9' ? 'selected' : ''  }}>09 - September</option>
            <option value="10" {{ old('keywordBulan', $entry['keywordBulan'] )== '10' ? 'selected' : ''  }}>10 - Oktober</option>
            <option value="11" {{ old('keywordBulan', $entry['keywordBulan'] )== '11' ? 'selected' : ''  }}>11 - November</option>
            <option value="12" {{ old('keywordBulan', $entry['keywordBulan'] )== '12' ? 'selected' : ''  }}>12 - Desember</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary offset-md-10">Cari sesuai filter</button>
</form>
<div class="row table-responsive">
    <table class="table table-striped" id="tabel_data">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah Donasi</th>
                <th>Cash/Transfer</th>
                <th>Bank</th>
                <th>Petugas</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>                
        @foreach ($riwayat as $riwa)
            <tr>
                <td>{{ $riwa->riwa_tanggal }}</td>
                <td>@money( $riwa->riwa_jml )</td>
                <td>{{ $riwa->riwa_jenis }}</td>
                <td>{{ $riwa->riwa_bank }}</td>
                <td>{{ $riwa->nama }}</td>
                <td><a href="/hapus_riwayat/{{ $riwa->riwa_id }}" class="btn btn-danger"><i class="fa fa-window-close-o"></i>Hapus</a></td>
            </tr>
        @endforeach
        @if ( Auth::user()->role == 3 || Auth::user()->role == 4 )
            <tr>
                <td colspan="5"><a href="/tambah_donatur/{{ $donatur->dona_id }}" data-record-id="{{ $donatur->dona_id }}" data-record-title="{{ $donatur->dona_nama }}" data-toggle="modal" data-target="#confirm-add" class="btn btn-success">Tambah Donasi</a></td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
<center>{{$riwayat->links()}}</center>
@endsection