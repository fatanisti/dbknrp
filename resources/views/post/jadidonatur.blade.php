@extends('app')

@section('pageTitle', 'Gabung Jadi Donatur')

@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one justify-content-center">
            <div class="row w-100">
                <div class="mx-auto">
                    @if (\Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                        <a href="/"><i class="fa fa-arrow-circle-o-left"></i> Kembali ke Landing Page</a>
                    </div>
                    @endif
                    <div class="auto-form-wrapper text-center" style="background-color: #7eceff; border-radius: 25px;">
                        <h4><b>FORM BIODATA CALON DONATUR</b></h4>
                        <br>
                        <form method="POST" action="{{ route('spn_dona') }}">
                            @csrf
                            <div class="form-row">                
                                <div class="form-group col-md-6">
                                    <label for="inputNama"><i class="fa fa-user-circle-o"></i> Nama Lengkap*</label>
                                    <input type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Nama Lengkap..." required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputBP"><i class="fa fa-star"></i> Tempat Lahir*</label>
                                    <input type="text" class="form-control" id="inputBP" name="inputBP" placeholder="Nama Kota/Kab..." required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputBOD"><i class="fa fa-calendar-o"></i> Tanggal Lahir*</label>
                                    <input type="date" class="form-control" id="inputBOD" name="inputBOD" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputAddress"><i class="fa fa-map-marker"></i> Alamat Domisili</label>
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
                                    <label for="inputKab">Kota/Kab*</label>
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
                                <div class="form-group col-md-4">
                                    <label for="inputProv">Provinsi*</label>
                                    <input type="text" class="form-control" id="inputProv" name="inputProv" value="Jawa Barat" readonly="readonly">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputNegara">Negara*</label>
                                    <input type="text" class="form-control" id="inputNegara" name="inputNegara" value="Indonesia" readonly="readonly">
                                </div>
                            </div>    
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputTelp"><i class="fa fa-phone"></i> Telepon</label>
                                    <input type="text" class="form-control" id="inputTelp" name="inputTelp">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputHP"><i class="fa fa-mobile-phone"></i> No. HP**</label>
                                    <input type="text" class="form-control" id="inputHP" name="inputHP" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail"><i class="fa fa-envelope"></i> Email*</label>
                                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Misal: abcdef@example.com" required>
                                </div>
                            </div>    
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputProf"><i class="fa fa-briefcase"></i> Profesi</label>
                                            <input type="text" class="form-control" id="inputProf" name="inputProf">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputFB"><i class="fa fa-facebook-square"></i> Akun Facebook</label>
                                            <input type="text" class="form-control" id="inputFB" name="inputFB">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputIG"><i class="fa fa-instagram"></i> Akun Instagram</label>
                                            <input type="text" class="form-control" id="inputIG" name="inputIG">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <p>Keterangan: (*) Wajib diisi, (**) Diutamakan yang terhubung dengan Whatsapp</p>
                            </div>
                            <div class="form-row justify-content-center">
                                <button type="submit" class="btn btn-success btn-rounded"><i class="fa fa-check-circle-o"></i> Bismillah, Saya Daftar</button>
                            </div>
                            <br>
                        </form>
                    </div>
                    <br>
                    <p class="footer-text text-center">Copyright © 2018 Bootstrapdash. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection