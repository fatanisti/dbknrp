@extends('app')

@section('pageTitle', 'Input Donasi Kegiatan')

@section('content')
<h4 class="text-center text-primary"><i class="fa fa-download"></i> @yield('pageTitle')</h4>
<div class="card-body text-center">
    <form action="{{ route('store_lap') }}" method="POST" class="forms-sample">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-12 col-12">
                <label for="inputKeg"><i class="fa fa-users"></i> Jenis Kegiatan</label>
                <select class="form-control" id="inputKeg" name="inputKeg">
                    <option value="Art Campaign" {{ old('inputKeg', $entry['inputKeg'] )== 'Art Campaign' ? 'selected' : ''  }}>Art Campaign</option>
                    <option value="Art Festival" {{ old('inputKeg', $entry['inputKeg'] )== 'Art Festival' ? 'selected' : ''  }}>Art Festival</option>
                    <option value="Big Concert" {{ old('inputKeg', $entry['inputKeg'] )== 'Big Concert' ? 'selected' : ''  }}>Big Concert</option>
                    <option value="Daurah Tilawah" {{ old('inputKeg', $entry['inputKeg'] )== 'Daurah Tilawah' ? 'selected' : ''  }}>Daurah Tilawah</option>
                    <option value="Dongeng" {{ old('inputKeg', $entry['inputKeg'] )== 'Dongeng' ? 'selected' : ''  }}>Dongeng</option>
                    <option value="Jaulah Syaikh" {{ old('inputKeg', $entry['inputKeg'] )== 'Jaulah Syaikh' ? 'selected' : ''  }}>Jaulah Syaikh</option>
                    <option value="Jumat Barokah" {{ old('inputKeg', $entry['inputKeg'] )== 'Jumat Barokah' ? 'selected' : ''  }}>Jumat Barokah</option>
                    <option value="Lomba Kreasi" {{ old('inputKeg', $entry['inputKeg'] )== 'Lomba Kreasi' ? 'selected' : ''  }}>Lomba Kreasi</option>
                    <option value="Mini Concert" {{ old('inputKeg', $entry['inputKeg'] )== 'Mini Concert' ? 'selected' : ''  }}>Mini Concert</option>
                    <option value="Nonton Bareng" {{ old('inputKeg', $entry['inputKeg'] )== 'Nonton Bareng' ? 'selected' : ''  }}>Nonton Bareng</option>
                    <option value="Open Booth" {{ old('inputKeg', $entry['inputKeg'] )== 'Open Booth' ? 'selected' : ''  }}>Open Booth</option>
                    <option value="Qurban Berkah" {{ old('inputKeg', $entry['inputKeg'] )== 'Qurban Berkah' ? 'selected' : ''  }}>Qurban Berkah</option>
                    <option value="Safari Ramadhan" {{ old('inputKeg', $entry['inputKeg'] )== 'Safari Ramadhan' ? 'selected' : ''  }}>Safari Ramadhan</option>
                    <option value="Seminar Inspirasi" {{ old('inputKeg', $entry['inputKeg'] )== 'Seminar Inspirasi' ? 'selected' : ''  }}>Seminar Inspirasi</option>
                    <option value="Lain-lain" {{ old('inputKeg', $entry['inputKeg'] )== 'Lain-lain' ? 'selected' : ''  }}>Lain-lain</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4 col-12">
                <label for="inputTgl"><i class="fa fa-calendar"></i> Tanggal Donasi</label>
                <input class="form-control" type="date" id="inputTgl" name="inputTgl" required>
            </div>
            <div class="form-group col-md-4 col-12">
                <label for="inputNama"><i class="fa fa-user-circle-o"></i> Nama Donatur</label>
                <input class="form-control" type="text" id="inputNama" name="inputNama" required>
            </div>
            <div class="form-group col-md-4 col-12">
                <label for="inputKab"><i class="fa fa-map-marker"></i> Domisili</label>
                <select class="form-control" id="inputKab" name="inputKab">
                    <option value="Kab. Bandung" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Bandung' ? 'selected' : ''  }}>Kab. Bandung</option>
                    <option value="Kab. Bandung Barat" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Bandung Barat' ? 'selected' : ''  }}>Kab. Bandung Barat</option>
                    <option value="Kab. Bekasi" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Bekasi' ? 'selected' : ''  }}>Kab. Bekasi</option>
                    <option value="Kab. Bogor" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Bogor' ? 'selected' : ''  }}>Kab. Bogor</option>
                    <option value="Kab. Ciamis" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Ciamis' ? 'selected' : ''  }}>Kab. Ciamis</option>
                    <option value="Kab. Cianjur" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Cianjur' ? 'selected' : ''  }}>Kab. Cianjur</option>
                    <option value="Kab. Cirebon" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Cirebon' ? 'selected' : ''  }}>Kab. Cirebon</option>
                    <option value="Kab. Garut" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Garut' ? 'selected' : ''  }}>Kab. Garut</option>
                    <option value="Kab. Indramayu" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Indramayu' ? 'selected' : ''  }}>Kab. Indramayu</option>
                    <option value="Kab. Karawang" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Karawang' ? 'selected' : ''  }}>Kab. Karawang</option>
                    <option value="Kab. Kuningan" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Kuningan' ? 'selected' : ''  }}>Kab. Kuningan</option>
                    <option value="Kab. Majalengka" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Majalengka' ? 'selected' : ''  }}>Kab. Majalengka</option>
                    <option value="Kab. Pangandaran" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Pangandaran' ? 'selected' : ''  }}>Kab. Pangandaran</option>
                    <option value="Kab. Purwakarta" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Purwakarta' ? 'selected' : ''  }}>Kab. Purwakarta</option>
                    <option value="Kab. Subang" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Subang' ? 'selected' : ''  }}>Kab. Subang</option>
                    <option value="Kab. Sukabumi" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Sukabumi' ? 'selected' : ''  }}>Kab. Sukabumi</option>
                    <option value="Kab. Sumedang" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Sumedang' ? 'selected' : ''  }}>Kab. Sumedang</option>
                    <option value="Kab. Tasikmalaya" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Tasikmalaya' ? 'selected' : ''  }}>Kab. Tasikmalaya</option>
                    <option value="Kota Bandung" {{ old('inputKab', $entry['inputKab'] )== 'Kota Bandung' ? 'selected' : ''  }}>Kota Bandung</option>
                    <option value="Kota Banjar" {{ old('inputKab', $entry['inputKab'] )== 'Kota Banjar' ? 'selected' : ''  }}>Kota Banjar</option>
                    <option value="Kota Bekasi" {{ old('inputKab', $entry['inputKab'] )== 'Kota Bekasi' ? 'selected' : ''  }}>Kota Bekasi</option>
                    <option value="Kota Bogor" {{ old('inputKab', $entry['inputKab'] )== 'Kota Bogor' ? 'selected' : ''  }}>Kota Bogor</option>
                    <option value="Kota Cimahi" {{ old('inputKab', $entry['inputKab'] )== 'Kota Cimahi' ? 'selected' : ''  }}>Kota Cimahi</option>
                    <option value="Kota Cirebon" {{ old('inputKab', $entry['inputKab'] )== 'Kota Cirebon' ? 'selected' : ''  }}>Kota Cirebon</option>
                    <option value="Kota Depok" {{ old('inputKab', $entry['inputKab'] )== 'Kota Depok' ? 'selected' : ''  }}>Kota Depok</option>
                    <option value="Kota Sukabumi" {{ old('inputKab', $entry['inputKab'] )== 'Kota Sukabumi' ? 'selected' : ''  }}>Kota Sukabumi</option>
                    <option value="Kota Tasikmalaya" {{ old('inputKab', $entry['inputKab'] )== 'Kota Tasikmalaya' ? 'selected' : ''  }}>Kota Tasikmalaya</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 col-12">
                <label for="inputDona"><i class="fa fa-money"></i> Besaran Donasi</label>
                <input type="number" class="form-control" id="inputDona" name="inputDona" required>
            </div>
            <div class="form-group col-md-3 col-12">
                <label for="inputJenis"><i class="fa fa-handshake-o"></i> Jenis Donasi</label>
                <select id="inputJenis" class="form-control" name="inputJenis">
                    <option value="Transfer">Transfer</option>
                    <option value="Cash">Cash</option>
                </select>
            </div>
            <div class="form-group col-md-3 col-12">
                <label for="inputBank"><i class="fa fa-bank"></i> Bank</label>
                <select id="inputBank" class="form-control" name="inputBank">
                    <option value="Bank Syariah Mandiri">Bank Syariah Mandiri</option>
                    <option value="CIMB Syariah">CIMB Syariah</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-inverse-success btn-rounded"><i class="fa fa-check-circle"></i> Simpan Donasi</button>
    </form>
</div>
@endsection