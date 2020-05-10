@extends('app')

@section('pageTitle', 'Sunting Data Donatur')

@section('content')
<h4 class="text-primary text-center"><i class="fa fa-edit"></i> @yield('pageTitle') | {{ $donatur->nama }}</h4>
<div class="card-body text-center">
    <form method="POST" action="{{ route('update_dona') }}">
    @csrf
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputIDDon"><i class="fa fa-barcode"></i> ID Donatur</label>
                <input type="text" class="form-control" id="inputIDDon" name="idDon" value="{{ $donatur->id }}" readonly>
            </div>
            <div class="form-group col-md-2">
                <label for="inputTglReg"><i class="fa fa-calendar"></i> Tanggal Registrasi</label>
                <input type="date" class="form-control" id="inputTglReg" name="inputTglReg" value="{{ $donatur->tgl_regis }}" readonly>
            </div>
            <div class="form-group col-md-7">
                <label for="inputNama"><i class="fa fa-user-circle-o"></i> Nama Lengkap</label>
                <input type="text" class="form-control" id="inputNama" name="inputNama" value="{{ $donatur->nama }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputBP"><i class="fa fa-star"></i> Tempat Lahir</label>
                        <input type="text" class="form-control" id="inputBP" name="inputBP" value="{{ $donatur->tempat_lahir }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputBOD"><i class="fa fa-calendar-o"></i> Tanggal Lahir</label>
                        <input type="date" class="form-control" id="inputBOD" name="inputBOD" value="{{ $donatur->tgl_lahir }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputAddress"><i class="fa fa-map-marker"></i> Alamat Domisili</label>
                        <input type="text" class="form-control" id="inputAddress" name="inputAddress" value="{{ $donatur->alamat }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-1">
                        <label for="inputRT">RT</label>
                        <input type="text" class="form-control" id="inputRT" name="inputRT" value="{{ $donatur->rt }}">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="inputRW">RW</label>
                        <input type="text" class="form-control" id="inputRW" name="inputRW" value="{{ $donatur->rw }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputKodepos">Kodepos</label>
                        <input type="text" class="form-control" id="inputKodepos" name="inputKodepos" value="{{ $donatur->kodepos }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputKel">Kelurahan</label>
                        <input type="text" class="form-control" id="inputKel" name="inputKel" value="{{ $donatur->kelurahan }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputKec">Kecamatan</label>
                        <input type="text" class="form-control" id="inputKec" name="inputKec" value="{{ $donatur->kecamatan }}">
                    </div>
                </div>
            </div>
        </div>    
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputKab">Kota/Kab</label>
                <select class="form-control" id="inputKab" name="inputKab">
                    <option value="Kab. Bandung" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Bandung' ? 'selected' : ''  }}>Kab. Bandung</option>
                    <option value="Kab. Bandung Barat" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Bandung Barat' ? 'selected' : ''  }}>Kab. Bandung Barat</option>
                    <option value="Kab. Bekasi" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Bekasi' ? 'selected' : ''  }}>Kab. Bekasi</option>
                    <option value="Kab. Bogor" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Bogor' ? 'selected' : ''  }}>Kab. Bogor</option>
                    <option value="Kab. Ciamis" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Ciamis' ? 'selected' : ''  }}>Kab. Ciamis</option>
                    <option value="Kab. Cianjur" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Cianjur' ? 'selected' : ''  }}>Kab. Cianjur</option>
                    <option value="Kab. Cirebon" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Cirebon' ? 'selected' : ''  }}>Kab. Cirebon</option>
                    <option value="Kab. Garut" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Garut' ? 'selected' : ''  }}>Kab. Garut</option>
                    <option value="Kab. Indramayu" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Indramayu' ? 'selected' : ''  }}>Kab. Indramayu</option>
                    <option value="Kab. Karawang" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Karawang' ? 'selected' : ''  }}>Kab. Karawang</option>
                    <option value="Kab. Kuningan" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Kuningan' ? 'selected' : ''  }}>Kab. Kuningan</option>
                    <option value="Kab. Majalengka" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Majalengka' ? 'selected' : ''  }}>Kab. Majalengka</option>
                    <option value="Kab. Pangandaran" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Pangandaran' ? 'selected' : ''  }}>Kab. Pangandaran</option>
                    <option value="Kab. Purwakarta" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Purwakarta' ? 'selected' : ''  }}>Kab. Purwakarta</option>
                    <option value="Kab. Subang" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Subang' ? 'selected' : ''  }}>Kab. Subang</option>
                    <option value="Kab. Sukabumi" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Sukabumi' ? 'selected' : ''  }}>Kab. Sukabumi</option>
                    <option value="Kab. Sumedang" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Sumedang' ? 'selected' : ''  }}>Kab. Sumedang</option>
                    <option value="Kab. Tasikmalaya" {{ old('inputKab', $donatur['kota_kab'] )== 'Kab. Tasikmalaya' ? 'selected' : ''  }}>Kab. Tasikmalaya</option>
                    <option value="Kota Bandung" {{ old('inputKab', $donatur['kota_kab'] )== 'Kota Bandung' ? 'selected' : ''  }}>Kota Bandung</option>
                    <option value="Kota Banjar" {{ old('inputKab', $donatur['kota_kab'] )== 'Kota Banjar' ? 'selected' : ''  }}>Kota Banjar</option>
                    <option value="Kota Bekasi" {{ old('inputKab', $donatur['kota_kab'] )== 'Kota Bekasi' ? 'selected' : ''  }}>Kota Bekasi</option>
                    <option value="Kota Bogor" {{ old('inputKab', $donatur['kota_kab'] )== 'Kota Bogor' ? 'selected' : ''  }}>Kota Bogor</option>
                    <option value="Kota Cimahi" {{ old('inputKab', $donatur['kota_kab'] )== 'Kota Cimahi' ? 'selected' : ''  }}>Kota Cimahi</option>
                    <option value="Kota Cirebon" {{ old('inputKab', $donatur['kota_kab'] )== 'Kota Cirebon' ? 'selected' : ''  }}>Kota Cirebon</option>
                    <option value="Kota Depok" {{ old('inputKab', $donatur['kota_kab'] )== 'Kota Depok' ? 'selected' : ''  }}>Kota Depok</option>
                    <option value="Kota Sukabumi" {{ old('inputKab', $donatur['kota_kab'] )== 'Kota Sukabumi' ? 'selected' : ''  }}>Kota Sukabumi</option>
                    <option value="Kota Tasikmalaya" {{ old('inputKab', $donatur['kota_kab'] )== 'Kota Tasikmalaya' ? 'selected' : ''  }}>Kota Tasikmalaya</option>
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
                <label for="inputTelp"><i class="fa fa-phone"></i> Telepon</label>
                <input type="text" class="form-control" id="inputTelp" name="inputTelp" value="{{ $donatur->no_telp }}">
            </div>
            <div class="form-group col-md-3">
                <label for="inputHP"><i class="fa fa-mobile-phone"></i> No. HP</label>
                <input type="text" class="form-control" id="inputHP" name="inputHP" value="{{ $donatur->no_hp }}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail"><i class="fa fa-envelope"></i> Email</label>
                <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="{{ $donatur->email }}">
            </div>
        </div>    
        <div class="form-row">
            <div class="form-group col-md-7">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputProf"><i class="fa fa-briefcase"></i> Profesi</label>
                        <input type="text" class="form-control" id="inputProf" name="inputProf" value="{{ $donatur->profesi }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputFB"><i class="fa fa-facebook-square"></i> Akun Facebook</label>
                        <input type="text" class="form-control" id="inputFB" name="inputFB" value="{{ $donatur->akun_facebook }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputIG"><i class="fa fa-instagram"></i> Akun Instagram</label>
                        <input type="text" class="form-control" id="inputIG" name="inputIG" value="{{ $donatur->akun_instagram }}">
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5">
                <div class="form-group col-md-12">
                    <label for="inputCatatan"><i class="fa fa-pencil"></i> Catatan</label>
                    <textarea style="min-height: 125px;" class="form-control" id="inputCatatan" name="inputCatatan" maxlength="150" placeholder="Maksimum 150 karakter...">{{ $donatur->catatan }}</textarea>
                </div>
            </div>
        </div>
        <div class="form-row justify-content-center">
            <div class="col-md-4">
                <a href="{{  url()->previous() }}" class="btn btn-light btn-rounded btn-block">
                    <i class="fa fa-times-circle"></i> {{ __('Batal') }}
                </a>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-inverse-success btn-rounded btn-block"><i class="fa fa-check-circle"></i> Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>
@endsection