@extends('app')

@section('pageTitle', 'Riwayat Donasi')

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
<form action="" method="POST" id="deldata">
    @csrf
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-danger">
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Penghapusan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Hapus data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-light btn-rounded" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-inverse-danger btn-rounded btn-ok">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="/simpan_riwayat/{{ $donatur->id }}" method="POST">
    @csrf
    <div class="modal fade" id="confirm-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-download"></i> Tambah Donasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12 col-12">
                            <label for="inputTgl"><i class="fa fa-calendar"></i> Tanggal Donasi</label>
                            <input type="date" class="form-control" id="inputTgl" name="inputTgl" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-12">
                            <label for="inputDona"><i class="fa fa-money"></i> Besaran Donasi</label>
                            <input type="number" class="form-control" id="inputDona" name="inputDona" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-12">
                            <label for="inputJenis"><i class="fa fa-handshake-o"></i> Jenis Donasi</label>
                            <select id="inputJenis" class="form-control" name="inputJenis">
                                <option value="Transfer">Transfer</option>
                                <option value="Cash">Cash</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-12">
                            <label for="inputBank"> <i class="fa fa-bank"></i>Bank</label>
                            <select id="inputBank" class="form-control" name="inputBank">
                                <option value="Bank Syariah Mandiri">Bank Syariah Mandiri</option>
                                <option value="CIMB Syariah">CIMB Syariah</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-light btn-rounded" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-inverse-success btn-rounded btn-ok">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-md-2 col-2">
        <a href="{{ route('dona_data') }}"><i class="fa fa-arrow-circle-o-left"></i></a>
    </div>
    <div class="col-md-10 col-10">
        <h4 class="text-primary text-center"><i class="fa fa-address-card-o"></i> @yield('pageTitle') | {{ $donatur->nama }}</h4>
    </div>
</div>
<div class="card-body text-center">
    <form action="{{ url()->current() }}" style="padding: 0px 0px 10px 0px;">
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend bg-info">
                        <span class="input-group-text bg-transparent">
                            <i class="fa fa-map-marker text-white"></i>
                        </span>
                    </div>
                    <p class="form-control">{{ $donatur->kota_kab }}</p>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend bg-primary">
                        <span class="input-group-text bg-transparent">
                            <i class="fa fa-user-circle-o text-white"></i>
                        </span>
                    </div>
                    <p class="form-control">{{ $donatur->nama }}</p>
                </div>
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
        <button type="submit" class="btn btn-inverse-primary btn-rounded"><i class="fa fa-search"></i>Cari sesuai filter</button>
    </form>
    </br>
    @if(!$riwayat->isEmpty())
    <div class="table-responsive">
        <table class="table table-bordered" id="tabel_data">
            <thead>
                <tr class="table-primary">
                    <th><i class="fa fa-calendar"></i> Tanggal</th>
                    <th><i class="fa fa-money"></i> Jumlah Donasi</th>
                    <th><i class="fa fa-handshake-o"></i> Cash/Transfer</th>
                    <th><i class="fa fa-bank"></i> Bank</th>
                    <th><i class="fa fa-user-circle-o"></i> Petugas</th>
                    <th><i class="fa fa-wrench"></i> Action</th>
                </tr>
            </thead>
            <tbody>                
            @foreach ($riwayat as $riwa)
                <tr class="table-light">
                    <td>{{ Date::parse($riwa->tanggal)->format('j F Y') }}</td>
                    <td>@money( $riwa->jml )</td>
                    <td>{{ $riwa->jenis }}</td>
                    <td>{{ $riwa->bank }}</td>
                    <td>{{ $riwa->penerima }}</td>
                    <td><a href="#" data-record-id="{{ $riwa->id }}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-inverse-danger btn-rounded"><i class="fa fa-trash-o"></i>Hapus</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    {{$riwayat->links()}}
    @else
    <h4>Tidak ada data tersimpan.</h4>
    @endif
    @if ( Auth::user()->role == 4 )
    <br>
    <a href="#" data-record-id="{{ $donatur->id }}" data-toggle="modal" data-target="#confirm-add" class="btn btn-inverse-success btn-rounded"><i class="fa fa-plus"></i> Tambah Donasi</a>
    @endif
</div>

<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        var data = $(e.relatedTarget).data();
        $('#deldata').attr('action', '/hapus_riwayat/' + data.recordId);
    });
</script>
@endsection