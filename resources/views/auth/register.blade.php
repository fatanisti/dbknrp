@extends('app')

@section('pageTitle', 'Buat Akun')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <h4 class="text-center text-primary">{{ __('Buat Admin Baru') }}</h4>
        <div class="card-body text-center">
            <form method="POST" action="{{ route('store_acc') }}">
                @csrf
                <div class="form-group row">
                    <label for="inputNama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>
                    <div class="col-md-6">
                        <input id="inputNama" type="text" class="form-control" name="inputNama" value="{{ old('inputNama') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputDomi" class="col-md-4 col-form-label text-md-right">{{ __('Domisili') }}</label>
                    <div class="col-md-6">
                        @if(Auth::user()->id == 3)
                        <p class="form-control" id="inputDomi" name="inputDomi">{{ Auth::user()->domisili }}</p>
                        @else
                        <select class="form-control" id="inputDomi" name="inputDomi">
                            <option value="Kab. Bandung" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Bandung' ? 'selected' : ''  }}>Kab. Bandung</option>
                            <option value="Kab. Bandung Barat" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Bandung Barat' ? 'selected' : ''  }}>Kab. Bandung Barat</option>
                            <option value="Kab. Bekasi" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Bekasi' ? 'selected' : ''  }}>Kab. Bekasi</option>
                            <option value="Kab. Bogor" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Bogor' ? 'selected' : ''  }}>Kab. Bogor</option>
                            <option value="Kab. Ciamis" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Ciamis' ? 'selected' : ''  }}>Kab. Ciamis</option>
                            <option value="Kab. Cianjur" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Cianjur' ? 'selected' : ''  }}>Kab. Cianjur</option>
                            <option value="Kab. Cirebon" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Cirebon' ? 'selected' : ''  }}>Kab. Cirebon</option>
                            <option value="Kab. Garut" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Garut' ? 'selected' : ''  }}>Kab. Garut</option>
                            <option value="Kab. Indramayu" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Indramayu' ? 'selected' : ''  }}>Kab. Indramayu</option>
                            <option value="Kab. Karawang" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Karawang' ? 'selected' : ''  }}>Kab. Karawang</option>
                            <option value="Kab. Kuningan" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Kuningan' ? 'selected' : ''  }}>Kab. Kuningan</option>
                            <option value="Kab. Majalengka" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Majalengka' ? 'selected' : ''  }}>Kab. Majalengka</option>
                            <option value="Kab. Pangandaran" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Pangandaran' ? 'selected' : ''  }}>Kab. Pangandaran</option>
                            <option value="Kab. Purwakarta" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Purwakarta' ? 'selected' : ''  }}>Kab. Purwakarta</option>
                            <option value="Kab. Subang" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Subang' ? 'selected' : ''  }}>Kab. Subang</option>
                            <option value="Kab. Sukabumi" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Sukabumi' ? 'selected' : ''  }}>Kab. Sukabumi</option>
                            <option value="Kab. Sumedang" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Sumedang' ? 'selected' : ''  }}>Kab. Sumedang</option>
                            <option value="Kab. Tasikmalaya" {{ old('inputDomi', $entry['inputDomi'] )== 'Kab. Tasikmalaya' ? 'selected' : ''  }}>Kab. Tasikmalaya</option>
                            <option value="Kota Bandung" {{ old('inputDomi', $entry['inputDomi'] )== 'Kota Bandung' ? 'selected' : ''  }}>Kota Bandung</option>
                            <option value="Kota Banjar" {{ old('inputDomi', $entry['inputDomi'] )== 'Kota Banjar' ? 'selected' : ''  }}>Kota Banjar</option>
                            <option value="Kota Bekasi" {{ old('inputDomi', $entry['inputDomi'] )== 'Kota Bekasi' ? 'selected' : ''  }}>Kota Bekasi</option>
                            <option value="Kota Bogor" {{ old('inputDomi', $entry['inputDomi'] )== 'Kota Bogor' ? 'selected' : ''  }}>Kota Bogor</option>
                            <option value="Kota Cimahi" {{ old('inputDomi', $entry['inputDomi'] )== 'Kota Cimahi' ? 'selected' : ''  }}>Kota Cimahi</option>
                            <option value="Kota Cirebon" {{ old('inputDomi', $entry['inputDomi'] )== 'Kota Cirebon' ? 'selected' : ''  }}>Kota Cirebon</option>
                            <option value="Kota Depok" {{ old('inputDomi', $entry['inputDomi'] )== 'Kota Depok' ? 'selected' : ''  }}>Kota Depok</option>
                            <option value="Kota Sukabumi" {{ old('inputDomi', $entry['inputDomi'] )== 'Kota Sukabumi' ? 'selected' : ''  }}>Kota Sukabumi</option>
                            <option value="Kota Tasikmalaya" {{ old('inputDomi', $entry['inputDomi'] )== 'Kota Tasikmalaya' ? 'selected' : ''  }}>Kota Tasikmalaya</option>
                        </select>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputHP" class="col-md-4 col-form-label text-md-right">{{ __('No. HP') }}</label>
                    <div class="col-md-6">
                        <input id="inputHP" type="text" class="form-control" name="inputHP" value="{{ old('inputHP') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-md-4 col-form-label text-md-right">{{ __('Alamat E-Mail') }}</label>
                    <div class="col-md-6">
                        <input id="inputEmail" type="email" class="form-control" name="inputEmail" value="{{ old('inputEmail') }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputRole" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                    <div class="col-md-6">
                        <select class="form-control" id="inputRole" name="inputRole">
                            @if ( Auth::user()->role == 1 )
                            <option value="2" {{ old('inputRole', $entry['inputRole'] )== '2' ? 'selected' : ''  }}>Admin Maker</option>
                            @elseif ( Auth::user()->role == 2 )
                            <option value="3" {{ old('inputRole', $entry['inputRole'] )== '3' ? 'selected' : ''  }}>Admin Daerah</option>
                            <option value="4" {{ old('inputRole', $entry['inputRole'] )== '4' ? 'selected' : ''  }}>Fundraiser</option>
                            @elseif ( Auth::user()->role == 3 )
                            <option value="4" {{ old('inputRole', $entry['inputRole'] )== '4' ? 'selected' : ''  }}>Fundraiser</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-0 justify-content-center">
                    <div class="col-md-4">
                        <a href="{{ route('manage_acc') }}" class="btn btn-inverse-light btn-rounded btn-block">
                            <i class="fa fa-times-circle"></i> {{ __('Batal') }}
                        </a>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-inverse-success btn-rounded btn-block">
                            <i class="fa fa-check-circle"></i> {{ __('Daftarkan') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
