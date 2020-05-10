@extends('app')

@section('pageTitle', 'Profil & Riwayat Donatur')

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
                <p class="form-control">{{ Auth::user()->profile->domisili }}</p>
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
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend bg-primary">
                    <span class="input-group-text bg-transparent">
                        <i class="fa fa-user-circle-o text-white"></i>
                    </span>
                </div>
                <input type="text" name="keywordNama" class="form-control" id="cariNama" placeholder="Masukan nama yang ingin dicari..." value="{{ old('keywordNama', $entry['keywordNama']) }}">
            </div>
        </div>
        <button type="submit" class="btn btn-inverse-primary btn-rounded"><i class="fa fa-search"></i> Cari</button>
    </form>
    @if(!$donatur->isEmpty())
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
            @foreach ($donatur as $donat)
                <tr class="table-light">
                    <td>{{ $donat->nama }}</td>
                    <td>{{ $donat->kota_kab }}</td>
                    <td>{{ $donat->no_hp }}</td>
                    <td>
                        <a href="/data_donatur/{{ $donat->id }}" class="btn btn-inverse-info btn-rounded"><i class="fa fa-address-card-o"></i>Profil</a>
                        <a href="/riwayat_donasi/{{ $donat->id }}" class="btn btn-inverse-success btn-rounded"><i class="fa fa-heart"></i>Riwayat</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    {{ $donatur->onEachSide(1)->links() }}
    @else
    <h4>Hasil pencarian tidak ditemukan.</h4>
    @endif
    <br>
    @if ( Auth::user()->role == 4 )
    <div class="row justify-content-center">
        <div class="col-md-4">
            <a href="{{ route('create_dona') }}" role="button" class="btn btn-inverse-success btn-rounded btn-block"><i class="fa fa-plus"></i> Donatur Baru</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('show_req') }}" role="button" class="btn btn-inverse-warning btn-rounded btn-block"><i class="fa fa-warning"></i> Permohonan Calon Donatur</a>
        </div>
    </div>
    @endif
</div>
@endsection