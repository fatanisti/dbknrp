@extends('app')

@section('pageTitle', 'Input Donasi Kegiatan')

@section('content')
<form action="{{ route('store_lap') }}" method="POST" class="forms-sample">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-4 col-12">
            <label for="inputTgl">Tanggal Donasi</label>
            <input class="form-control" type="date" id="inputTgl" name="inputTgl">
        </div>
        <div class="form-group col-md-4 col-12">
            <label for="inputNama">Nama Donatur</label>
            <input class="form-control" type="text" id="inputNama" name="inputNama">
        </div>
        <div class="form-group col-md-4 col-12">
            <label for="inputKab">Domisili</label>
            <select class="form-control" id="inputKab" name="inputKab">
                <option value="Kab. Bandung" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Bandung' ? 'selected' : ''  }}>Kab. Bandung</option>
                <option value="Kab. Bandung Barat" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Bandung Barat' ? 'selected' : ''  }}>Kab. Bandung Barat</option>
                <option value="Kab. Bekasi" {{ old('inputKab', $entry['inputKab'] )== 'Kab. Bekasi' ? 'selected' : ''  }}>Kab. Bekasi</option>
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
            <label for="inputDona">Besaran Donasi</label>
            <input type="number" class="form-control" id="inputDona" name="inputDona">
        </div>
        <div class="form-group col-md-3 col-12">
            <label for="inputJenis">Jenis Donasi</label>
            <select id="inputJenis" class="form-control" name="inputJenis">
                <option value="Transfer">Transfer</option>
                <option value="Cash">Cash</option>
            </select>
        </div>
        <div class="form-group col-md-3 col-12">
            <label for="inputBank">Bank</label>
            <select id="inputBank" class="form-control" name="inputBank">
                <option value="Bank Syariah Mandiri">Bank Syariah Mandiri</option>
                <option value="CIMB Syariah">CIMB Syariah</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Simpan Donasi</button>
</form>
@endsection