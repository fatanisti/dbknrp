@extends('app')

@section('pageTitle', 'Permohonan Bergabung')

@section('content')
<div class="modal fade" id="check-profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-info">
                <h4 class="modal-title" id="myModalLabel">Biodata Calon Donatur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4"><h5>Tanggal Daftar</h5></div>
                    <div class="col-md-8"><i class="fa fa-calendar"></i> <div id="caldaf"></div></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4"><h5>Nama Lengkap</h5></div>
                    <div class="col-md-8"><i class="fa fa-user-circle-o"></i> <div id="calnama"></div></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4"><h5>Tempat Lahir</h5></div>
                    <div class="col-md-8"><i class="fa fa-star"></i> <div id="caltl"></div></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4"><h5>Tanggal Lahir</h5></div>
                    <div class="col-md-8"><i class="fa fa-calendar-o"></i> <div id="caltgl"></div></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4"><h5>Alamat Domisili</h5></div>
                    <div class="col-md-8"><i class="fa fa-map-marker"></i> <div id="caladd"></div></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4"><h5>Telepon/No. HP</h5></div>
                    <div class="col-md-8"><i class="fa fa-phone"></i> <div id="caltel"></div></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4"><h5>Email</h5></div>
                    <div class="col-md-8"><i class="fa fa-envelope"></i> <div id="calema"></div></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4"><h5>Facebook</h5></div>
                    <div class="col-md-8"><i class="fa fa-facebook-square"></i> <div id="calfb"></div></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4"><h5>Instagram</h5></div>
                    <div class="col-md-8"><i class="fa fa-instagram"></i> <div id="calig"></div></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4"><h5>Profesi</h5></div>
                    <div class="col-md-8"><i class="fa fa-briefcase"></i> <div id="calpfs"></div></div>
                </div><br>
            </div>
        </div>
    </div>
</div>
<form action="" method="POST" id="accept">
    @csrf
    <div class="modal fade" id="accept-requ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-success">
                    <h4 class="modal-title" id="myModalLabel">Terima Calon Donatur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menerima permohonan calon donatur <b id="accnama"></b> dari <b id="accasal"></b> dan menjadikan anda sebagai fundraisernya.</p>
                    <p>Tetap lanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-light btn-rounded" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-inverse-success btn-rounded btn-ok">Terima</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="" method="POST" id="ignore">
    @csrf
    <div class="modal fade" id="ignore-requ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-danger">
                    <h4 class="modal-title" id="myModalLabel">Tolak Calon Donatur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menolak permohonan calon donatur <b id="ignnama"></b> dari <b id="ignasal"></b> dan menghapus datanya dari database permohonan secara permanen.</p>
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
    <a href="{{ route('dona_data') }}"><i class="fa fa-arrow-circle-o-left"></i> Cek Data Donatur</a>
</div>
@endif
<h4 class="text-primary text-center"><i class="fa fa-address-book-o"></i> @yield('pageTitle')</h4>
<div class="card-body text-center">
    <form action="{{ url()->current() }}" style="padding: 0px 0px 10px 0px;">
        <div class="form-group" method="GET">
            <div class="input-group">
                <div class="input-group-prepend bg-info">
                    <span class="input-group-text bg-transparent">
                        <i class="fa fa-map-marker text-white"></i>
                    </span>
                </div>
                @if (Auth::user()->role == 3)
                <p class="form-control">{{ Auth::user()->domisili }}</p>
                @else
                <select class="form-control" id="daerah" name="keywordDaerah">
                    <option value="">--- Semua ---</option>
                    <option value="Kab. Bandung" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Bandung' ? 'selected' : ''  }}>Kab. Bandung</option>
                    <option value="Kab. Bandung Barat" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Bandung Barat' ? 'selected' : ''  }}>Kab. Bandung Barat</option>
                    <option value="Kab. Bekasi" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Bekasi' ? 'selected' : ''  }}>Kab. Bekasi</option>
                    <option value="Kab. Bogor" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Bogor' ? 'selected' : ''  }}>Kab. Bogor</option>
                    <option value="Kab. Ciamis" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Ciamis' ? 'selected' : ''  }}>Kab. Ciamis</option>
                    <option value="Kab. Cianjur" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Cianjur' ? 'selected' : ''  }}>Kab. Cianjur</option>
                    <option value="Kab. Cirebon" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Cirebon' ? 'selected' : ''  }}>Kab. Cirebon</option>
                    <option value="Kab. Garut" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Garut' ? 'selected' : ''  }}>Kab. Garut</option>
                    <option value="Kab. Indramayu" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Indramayu' ? 'selected' : ''  }}>Kab. Indramayu</option>
                    <option value="Kab. Karawang" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Karawang' ? 'selected' : ''  }}>Kab. Karawang</option>
                    <option value="Kab. Kuningan" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Kuningan' ? 'selected' : ''  }}>Kab. Kuningan</option>
                    <option value="Kab. Majalengka" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Majalengka' ? 'selected' : ''  }}>Kab. Majalengka</option>
                    <option value="Kab. Pangandaran" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Pangandaran' ? 'selected' : ''  }}>Kab. Pangandaran</option>
                    <option value="Kab. Purwakarta" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Purwakarta' ? 'selected' : ''  }}>Kab. Purwakarta</option>
                    <option value="Kab. Subang" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Subang' ? 'selected' : ''  }}>Kab. Subang</option>
                    <option value="Kab. Sukabumi" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Sukabumi' ? 'selected' : ''  }}>Kab. Sukabumi</option>
                    <option value="Kab. Sumedang" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Sumedang' ? 'selected' : ''  }}>Kab. Sumedang</option>
                    <option value="Kab. Tasikmalaya" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Tasikmalaya' ? 'selected' : ''  }}>Kab. Tasikmalaya</option>
                    <option value="Kota Bandung" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kota Bandung' ? 'selected' : ''  }}>Kota Bandung</option>
                    <option value="Kota Banjar" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kota Banjar' ? 'selected' : ''  }}>Kota Banjar</option>
                    <option value="Kota Bekasi" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kota Bekasi' ? 'selected' : ''  }}>Kota Bekasi</option>
                    <option value="Kota Bogor" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kota Bogor' ? 'selected' : ''  }}>Kota Bogor</option>
                    <option value="Kota Cimahi" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kota Cimahi' ? 'selected' : ''  }}>Kota Cimahi</option>
                    <option value="Kota Cirebon" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kota Cirebon' ? 'selected' : ''  }}>Kota Cirebon</option>
                    <option value="Kota Depok" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kota Depok' ? 'selected' : ''  }}>Kota Depok</option>
                    <option value="Kota Sukabumi" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kota Sukabumi' ? 'selected' : ''  }}>Kota Sukabumi</option>
                    <option value="Kota Tasikmalaya" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kota Tasikmalaya' ? 'selected' : ''  }}>Kota Tasikmalaya</option>
                </select>
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-inverse-primary btn-rounded"><i class="fa fa-search"></i> Cari</button>
    </form>
    @if(!$result->isEmpty())
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th><i class="fa fa-user-circle-o"></i> Nama</th>
                    <th><i class="fa fa-map-marker"></i> Daerah</th>
                    <th><i class="fa fa-phone"></i> No. HP</th>
                    <th><i class="fa fa-wrench"></i> Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($result as $res)
                <tr class="table-light">
                    <td>{{ $res->dona_nama }}</td>
                    <td>{{ $res->dona_kota_kab }}</td>
                    <td>{{ $res->dona_no_hp }}</td>
                    <td>
                        <a href="#"
                            data-record-tgl="{{ Date::parse($res->created_at)->format('j F Y') }}"
                            data-record-name="{{ $res->dona_nama }}"
                            data-record-pob="{{ $res->dona_tempat_lahir }}"
                            data-record-dob="{{ Date::parse($res->dona_tgl_lahir)->format('j F Y') }}"
                            data-record-add="{{ $res->dona_alamat }}"
                            data-record-rt="{{ $res->dona_rt }}"
                            data-record-rw="{{ $res->dona_rw }}"
                            data-record-kp="{{ $res->dona_kodepos }}"
                            data-record-kel="{{ $res->dona_kelurahan }}"
                            data-record-kec="{{ $res->dona_kecamatan }}"
                            data-record-kot="{{ $res->dona_kota_kab }}"
                            data-record-pvs="{{ $res->dona_provinsi }}"
                            data-record-neg="{{ $res->dona_negara }}"
                            data-record-tel="{{ $res->dona_no_telp }}"
                            data-record-hp="{{ $res->dona_no_hp }}"
                            data-record-ema="{{ $res->dona_email }}"
                            data-record-fb="{{ $res->dona_akun_facebook }}"
                            data-record-ig="{{ $res->dona_akun_instagram }}"
                            data-record-pfs="{{ $res->dona_profesi }}"
                            data-toggle="modal" data-target="#check-profile" class="btn btn-inverse-info btn-rounded"><i class="fa fa-address-card-o"></i>Biodata</a>
                        <a href="#" data-record-id="{{ $res->dona_id }}" data-record-name="{{ $res->dona_nama }}" data-record-add="{{ $res->dona_kota_kab }}" data-toggle="modal" data-target="#accept-requ" class="btn btn-inverse-success btn-rounded"><i class="fa fa-plus"></i>Terima</a>
                        <a href="#" data-record-id="{{ $res->dona_id }}" data-record-name="{{ $res->dona_nama }}" data-record-add="{{ $res->dona_kota_kab }}" data-toggle="modal" data-target="#ignore-requ" class="btn btn-inverse-danger btn-rounded"><i class="fa fa-times"></i>Tolak</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        {{ $result->onEachSide(1)->links() }}
    </div>
    @else
    <h4>Tidak ada permohonan masuk.</h4>
    @endif
</div>

<script>
    $('#check-profile').on('show.bs.modal', function(e) {
        var data = $(e.relatedTarget).data();
        $('#caldaf').text(data.recordTgl);
        $('#calnama').text(data.recordName);
        $('#caltl').text(data.recordPob);
        $('#caltgl').text(data.recordDob);
        $('#caladd').text(data.recordAdd + " RT " + data.recordRt + " RW " + data.recordRw + ", " + data.recordKel + ", " + data.recordKec + ", " + data.recordKot + ", " + data.recordPvs + ", " + data.recordNeg + " " + data.recordKp);
        $('#caltel').text(data.recordTel + " / " + data.recordHp);
        $('#calema').text(data.recordEma);
        $('#calfb').text(data.recordFb);
        $('#calig').text(data.recordIg);
        $('#calpfs').text(data.recordPfs);
    });
    $('#accept-requ').on('show.bs.modal', function(e) {
        var data = $(e.relatedTarget).data();
        $('#accept').attr('action', '/terima_permohonan/' + data.recordId);
        $('#accnama').text(data.recordName);
        $('#accasal').text(data.recordAdd);
    });
    $('#ignore-requ').on('show.bs.modal', function(e) {
        var data = $(e.relatedTarget).data();
        $('#ignore').attr('action', '/tolak_permohonan/' + data.recordId);
        $('#ignnama').text(data.recordName);
        $('#ignasal').text(data.recordAdd);
    });
</script>
@endsection