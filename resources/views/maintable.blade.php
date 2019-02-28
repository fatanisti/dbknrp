@extends('app')

@if (Route::current()->getName() == 'dona_data' || Route::current()->getName() == 'dona_data_fr')
    @section('pageTitle', 'Data Donatur')
@else
    @section('pageTitle', 'Riwayat Donasi')
@endif

@section('content')
<form action="{{ url()->current() }}" style="padding: 0px 0px 10px 0px;">
    <div class="form-group" method="GET">
        <label for="daerah"><i class="fa fa-map-marker"></i> Daerah</label>
        <select class="form-control" id="daerah" name="keywordDaerah">
            <option value="">--- Semua ---</option>
            <option value="Kab. Bandung" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Bandung' ? 'selected' : ''  }}>Kab. Bandung</option>
            <option value="Kab. Bandung Barat" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Bandung Barat' ? 'selected' : ''  }}>Kab. Bandung Barat</option>
            <option value="Kab. Bekasi" {{ old('keywordDaerah', $entry['keywordDaerah'] )== 'Kab. Bekasi' ? 'selected' : ''  }}>Kab. Bekasi</option>
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
    </div>
@if (Route::current()->getName() == 'dona_riwa' || Route::current()->getName() == 'dona_riwa_fr')
    <div class="form-group">
        <label for="cariNama"><i class="fa fa-user-o"></i> Cari Nama</label>
        <input type="text" name="keywordNama" class="form-control" id="cariNama" placeholder="Masukan nama yang ingin dicari..." value="{{ old('keywordNama', $entry['keywordNama']) }}">
    </div>
@endif
    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Cari</button>
@if ( (Auth::user()->role == 3 || Auth::user()->role == 4) && (Route::current()->getName() == 'dona_data' || Route::current()->getName() == 'dona_data_fr') )
    <a href="{{ route('create_dona') }}" role="button" class="btn btn-warning offset-md-9">Tambah Donatur</a>
@endif
</form>
<div class="row table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Daerah</th>
                <th>No. HP</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($donatur as $donat)
            <tr>
                <td>{{ $donat->dona_nama }}</td>
                <td>{{ $donat->dona_kota_kab }}</td>
                <td>{{ $donat->dona_no_hp }}</td>
            @if (Route::current()->getName() == 'dona_data')
                <td><a href="/data_donatur/{{ $donat->dona_id }}" class="btn btn-primary" style="width: 100%;"><i class="fa fa-address-card-o"></i>Profil</a></td>
            @elseif (Route::current()->getName() == 'dona_riwa')
                <td><a href="/riwayat_donasi/{{ $donat->dona_id }}" class="btn btn-success" style="width: 100%;"><i class="fa fa-heart"></i>Riwayat</a></td>
            @elseif (Route::current()->getName() == 'dona_data_fr')
                <td><a href="/data_donatur/{{ $donat->dona_id }}" class="btn btn-primary" style="width: 100%;"><i class="fa fa-address-card-o"></i>Profil</a></td>
            @else
                <td><a href="/riwayat_donasi/{{ $donat->dona_id }}" class="btn btn-success" style="width: 100%;"><i class="fa fa-heart"></i>Riwayat</a></td>
            @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    {{ $donatur->onEachSide(1)->links() }}
</div>
@endsection