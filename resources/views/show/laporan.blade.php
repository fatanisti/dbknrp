@extends('app')

@section('pageTitle', 'Laporan')

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
<h4 class="text-primary text-center"><i class="fa fa-bar-chart-o"></i> @yield('pageTitle')</h4>
<div class="card-body text-center">
    <form action="{{ url()->current() }}" style="padding: 0px 0px 10px 0px;">
        <div class="form-row">
            <div class="form-group col-md-4 col-12">
                <label for="daerah">Daerah</label>
                @if( Auth::user()->role == 3 )
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
            <div class="form-group col-md-4 col-6">
                <label for="bulan">Bulan</label>
                <select id="bulan" class="form-control" name="keywordBulan">
                    <option value="">--- Semua ---</option>
                    <option value="01" {{ old('keywordBulan', $entry['keywordBulan'] )== '01' ? 'selected' : ''  }}>01 - Januari</option>
                    <option value="02" {{ old('keywordBulan', $entry['keywordBulan'] )== '02' ? 'selected' : ''  }}>02 - Februari</option>
                    <option value="03" {{ old('keywordBulan', $entry['keywordBulan'] )== '03' ? 'selected' : ''  }}>03 - Maret</option>
                    <option value="04" {{ old('keywordBulan', $entry['keywordBulan'] )== '04' ? 'selected' : ''  }}>04 - April</option>
                    <option value="05" {{ old('keywordBulan', $entry['keywordBulan'] )== '05' ? 'selected' : ''  }}>05 - Mei</option>
                    <option value="06" {{ old('keywordBulan', $entry['keywordBulan'] )== '06' ? 'selected' : ''  }}>06 - Juni</option>
                    <option value="07" {{ old('keywordBulan', $entry['keywordBulan'] )== '07' ? 'selected' : ''  }}>07 - Juli</option>
                    <option value="08" {{ old('keywordBulan', $entry['keywordBulan'] )== '08' ? 'selected' : ''  }}>08 - Agustus</option>
                    <option value="09" {{ old('keywordBulan', $entry['keywordBulan'] )== '09' ? 'selected' : ''  }}>09 - September</option>
                    <option value="10" {{ old('keywordBulan', $entry['keywordBulan'] )== '10' ? 'selected' : ''  }}>10 - Oktober</option>
                    <option value="11" {{ old('keywordBulan', $entry['keywordBulan'] )== '11' ? 'selected' : ''  }}>11 - November</option>
                    <option value="12" {{ old('keywordBulan', $entry['keywordBulan'] )== '12' ? 'selected' : ''  }}>12 - Desember</option>
                </select>
            </div>
            <div class="form-group col-md-4 col-6">
                <label for="tahun">Tahun</label>
                <select id="tahun" class="form-control" name="keywordTahun">
                    <option value="">--- Semua ---</option>
                @for ($i = 2018; $i<=2050; $i++)
                    <option value="{{$i}}" {{ old('keywordTahun', $entry['keywordTahun'] )== $i ? 'selected' : ''  }}>{{$i}}</option>
                @endfor
                </select>
            </div>
        </div>
        <div class="form-row justify-content-center">
            <div class="form-group">
                <button type="submit" class="btn btn-inverse-primary btn-rounded"><i class="fa fa-folder-open-o"></i> Tampilkan Laporan</button>
            </div>
        </div>
    </form>
    @if(!$result->isEmpty())
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered" id="tabel_laporan">
                <caption>Rangkuman Data Donasi</caption>
                <thead>
                    <tr class="table-primary">
                        <th>Jumlah Donasi</th>
                        <th>Jumlah Fundraiser Terlibat</th>
                        <th>Jumlah Donatur Terlibat</th>
                        <th>Jumlah Uang Donasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-light">
                    @if (Auth::user()->role == 4)
                        <td>{{ $result->count() }}</td>
                        <td>{{ $result->groupBy('fund_id')->count('fund_id') }}</td>
                        <td>{{ $result->groupBy('user_id')->count('user_id') }}</td>
                        <td>@money( $result->sum('riwa_jml') )</td>
                    @else
                        <td>{{ $result->count() }}</td>
                        <td>{{ $result->groupBy('lap_penerima')->count('lap_penerima') }}</td>
                        <td>{{ $result->groupBy('lap_pemberi')->count('lap_pemberi') }}</td>
                        <td>@money( $result->sum('lap_jml') )</td>
                    @endif
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
        @if(!$result2->isEmpty())
        <div class="table-responsive">
            <table class="table table-bordered" id="tabel_laporan">
                <caption>Detail Donasi</caption>
                <thead>
                    <tr class="table-primary">
                    @if (Auth::user()->role != 1)
                        <th>Tanggal Terima</th>
                        <th>Kegiatan</th>
                        <th>Nama Penerima</th>
                        <th>Asal Daerah</th>
                        <th>Nama Donatur</th>
                        <th>Domisili</th>
                        <th>Jumlah Donasi</th>
                        <th>Action</th>
                    @else
                        <th>Periode</th>
                        <th>Daerah</th>
                        <th>Jumlah Donasi</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @if (Auth::user()->role == 4)
                        @foreach ($result2 as $res2)
                    <tr class="table-light">
                        <td>{{ Date::parse($res2->riwa_tanggal)->format('j F Y') }}</td>
                        <td>Donasi Reguler</td>
                        <td>{{ $res2->riwa_penerima }}</td>
                        <td>{{ $res2->riwa_domisili }}</td>
                        <td>{{ $res2->dona_nama }}</td>
                        <td>{{ $res2->dona_kota_kab }}</td>
                        <td>@money( $res2->riwa_jml )</td>
                        <td><a href="/hapus_donasi/{{ $res2->riwa_id }}" class="btn btn-inverse-danger btn-rounded"><i class="fa fa-trash-o"></i>Hapus</a></td>
                    </tr>
                        @endforeach
                    @elseif (Auth::user()->role == 1)
                        @foreach ($result2 as $res2)
                    <tr class="table-light">
                        <td><p>{{ $res2->year }}/{{ $res2->month }}</p></td>
                        <td>{{ $res2->area }}</td>
                        <td>@money( $res2->total )</td>
                    </tr>
                        @endforeach
                    @else
                        @foreach ($result2 as $res2)
                    <tr class="table-light">
                        <td>{{ Date::parse($res2->lap_tanggal)->format('j F Y') }}</td>
                        <td>{{ $res2->lap_kegiatan }}</td>
                        <td>{{ $res2->lap_penerima }}</td>
                        <td>{{ $res2->lap_domisili }}</td>
                        <td>{{ $res2->lap_pemberi }}</td>
                        <td>{{ $res2->lap_asal }}</td>
                        <td>@money( $res2->lap_jml )</td>
                        <td><a href="/hapus_donasi/{{ $res2->lap_id }}" class="btn btn-inverse-danger btn-rounded"><i class="fa fa-trash-o"></i>Hapus</a></td>
                    </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="row justify-content-center"><h4>Tidak ada data tersimpan.</h4></div>
    @endif        
    {{ $result2->appends(\Request::except('_token'))->links() }}
    @if(!$result2->isEmpty())
    <br>
    <div class="row justify-content-center">
        <a href="{{ route('unduh_lap') }}" class="btn btn-inverse-success btn-rounded"><i class="fa fa-cloud-download"></i>Download Excel (Semua)</a>
    </div>
    @endif
</div>
@endsection