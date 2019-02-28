@extends('app')

@section('pageTitle', 'Input/Ubah Data Donatur')

@section('content')
<div class="card">
    @if (Route::current()->getName() == 'create_dona')
    <div class="card-header">TAMBAH DONATUR</div>
    <div class="card-body">
        <form method="POST" action="{{ route('store_dona') }}">
        @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputIDDon">ID Donatur</label>
                    <input type="text" class="form-control" id="inputIDDon" name="idDon" value="{{ $entry['idDon'] }}" readonly>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputTglReg">Tanggal Registrasi</label>
                    <input type="date" class="form-control" id="inputTglReg" name="inputTglReg" required>
                </div>
                <div class="form-group col-md-7">
                    <label for="inputNama">Nama Lengkap</label>
                    <input type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Nama Lengkap..." required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-9">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="inputBP">Tempat Lahir</label>
                            <input type="text" class="form-control" id="inputBP" name="inputBP" placeholder="Nama Kota/Kab..." required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputBOD">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="inputBOD" name="inputBOD" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputAddress">Alamat Domisili</label>
                            <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Masukkan nama jalan di sini...">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-1">
                            <label for="inputRT">RT</label>
                            <input type="text" class="form-control" id="inputRT" name="inputRT">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputRW">RW</label>
                            <input type="text" class="form-control" id="inputRW" name="inputRW">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputKodepos">Kodepos</label>
                            <input type="text" class="form-control" id="inputKodepos" name="inputKodepos">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputKel">Kelurahan</label>
                            <input type="text" class="form-control" id="inputKel" name="inputKel">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputKec">Kecamatan</label>
                            <input type="text" class="form-control" id="inputKec" name="inputKec">
                        </div>
                    </div>
                </div>
            </div>    
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputKab">Kota/Kab</label>
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
                <div class="form-group col-md-4">
                    <label for="inputProv">Provinsi</label>
                    <input type="text" class="form-control" id="inputProv" name="inputProv" value="Jawa Barat" readonly="readonly">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputNegara">Negara</label>
                    <input type="text" class="form-control" id="inputNegara" name="inputNegara" value="Indonesia" readonly="readonly">
                </div>
            </div>    
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputTelp">Telepon</label>
                    <input type="text" class="form-control" id="inputTelp" name="inputTelp">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputHP">No. HP</label>
                    <input type="text" class="form-control" id="inputHP" name="inputHP">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Misal: abcdef@example.com">
                </div>
            </div>    
            <div class="form-row">
                <div class="form-group col-md-7">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputProf">Profesi</label>
                            <input type="text" class="form-control" id="inputProf" name="inputProf">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputFB">Akun Facebook</label>
                            <input type="text" class="form-control" id="inputFB" name="inputFB">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputIG">Akun Instagram</label>
                            <input type="text" class="form-control" id="inputIG" name="inputIG">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputDona">Besaran Donasi</label>
                            <input type="number" class="form-control" id="inputDona" name="inputDona" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputJenis">Jenis Donasi</label>
                            <select id="inputJenis" class="form-control" name="inputJenis">
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputBank">Bank</label>
                            <select id="inputBank" class="form-control" name="inputBank">
                                <option value="BSM">BSM</option>
                                <option value="BNI">BNI</option>
                                <option value="CIMB Syariah">CIMB Syariah</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <div class="form-group col-md-12">
                        <label for="inputCatatan">Catatan</label>
                        <textarea style="min-height: 125px;" class="form-control" id="inputCatatan" name="inputCatatan" maxlength="150" placeholder="Maksimum 150 karakter..."></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Daftarkan</button>
        </form>
    </div>
    @else
    <div class="card-header">UBAH DATA DONATUR</div>
    <div class="card-body">
        <form method="POST" action="{{ route('update_dona') }}">
        @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputIDDon">ID Donatur</label>
                    <input type="text" class="form-control" id="inputIDDon" name="idDon" value="{{ $donatur->dona_id }}" readonly>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputTglReg">Tanggal Registrasi</label>
                    <input type="date" class="form-control" id="inputTglReg" name="inputTglReg" value="{{ $donatur->dona_tgl_regis }}" readonly>
                </div>
                <div class="form-group col-md-7">
                    <label for="inputNama">Nama Lengkap</label>
                    <input type="text" class="form-control" id="inputNama" name="inputNama" value="{{ $donatur->dona_nama }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-9">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="inputBP">Tempat Lahir</label>
                            <input type="text" class="form-control" id="inputBP" name="inputBP" value="{{ $donatur->dona_tempat_lahir }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputBOD">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="inputBOD" name="inputBOD" value="{{ $donatur->dona_tgl_lahir }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputAddress">Alamat Domisili</label>
                            <input type="text" class="form-control" id="inputAddress" name="inputAddress" value="{{ $donatur->dona_alamat }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-1">
                            <label for="inputRT">RT</label>
                            <input type="text" class="form-control" id="inputRT" name="inputRT" value="{{ $donatur->dona_rt }}">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputRW">RW</label>
                            <input type="text" class="form-control" id="inputRW" name="inputRW" value="{{ $donatur->dona_rw }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputKodepos">Kodepos</label>
                            <input type="text" class="form-control" id="inputKodepos" name="inputKodepos" value="{{ $donatur->dona_kodepos }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputKel">Kelurahan</label>
                            <input type="text" class="form-control" id="inputKel" name="inputKel" value="{{ $donatur->dona_kelurahan }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputKec">Kecamatan</label>
                            <input type="text" class="form-control" id="inputKec" name="inputKec" value="{{ $donatur->dona_kecamatan }}">
                        </div>
                    </div>
                </div>
            </div>    
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputKab">Kota/Kab</label>
                    <input type="text" class="form-control" id="inputKab" name="inputKab" readonly="readonly" value="{{ $donatur->dona_kota_kab }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputProv">Provinsi</label>
                    <input type="text" class="form-control" id="inputProv" name="inputProv" value="Jawa Barat" readonly="readonly">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputNegara">Negara</label>
                    <input type="text" class="form-control" id="inputNegara" name="inputNegara" value="Indonesia" readonly="readonly">
                </div>
            </div>    
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputTelp">Telepon</label>
                    <input type="text" class="form-control" id="inputTelp" name="inputTelp" value="{{ $donatur->dona_no_telp }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputHP">No. HP</label>
                    <input type="text" class="form-control" id="inputHP" name="inputHP" value="{{ $donatur->dona_no_hp }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="{{ $donatur->dona_email }}">
                </div>
            </div>    
            <div class="form-row">
                <div class="form-group col-md-7">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputProf">Profesi</label>
                            <input type="text" class="form-control" id="inputProf" name="inputProf" value="{{ $donatur->dona_profesi }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputFB">Akun Facebook</label>
                            <input type="text" class="form-control" id="inputFB" name="inputFB" value="{{ $donatur->dona_akun_facebook }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputIG">Akun Instagram</label>
                            <input type="text" class="form-control" id="inputIG" name="inputIG" value="{{ $donatur->dona_akun_instagram }}">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <div class="form-group col-md-12">
                        <label for="inputCatatan">Catatan</label>
                        <textarea style="min-height: 125px;" class="form-control" id="inputCatatan" name="inputCatatan" maxlength="150" placeholder="Maksimum 150 karakter..." value="{{ $donatur->dona_catatan }}"></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>
    @endif
</div>
@endsection