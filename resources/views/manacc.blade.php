@extends('app')

@section('pageTitle', 'Kelola Akun')

@section('content')
<div class="card-header"><h3>{{ __('KELOLA AKUN ADMIN') }}</h3></div>
<div class="card-body">
    @if ( Auth::user()->role != 4)
    <div class="row justify-content-center">
        <div class="col-md-12 col-12">
            <a href="{{ route('create_acc') }}" class="btn btn-success">Buat Admin
                <i class="mdi mdi-plus"></i>
            </a>
        </div>
    </div><br>
    @endif
    <div class="row table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Domisili</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($mamas as $adm)
                <tr>
                    <td>{{ $adm->nama }}</td>
                    <td>{{ $adm->domisili }}</td>
                    <td><a href="/info_akun/{{ $adm->id }}" class="btn btn-primary" style="width: 100%;"><i class="fa fa-window-maximize"></i>Cek Akun</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        {{ $mamas->onEachSide(1)->links() }}
    </div>
</div>
@endsection