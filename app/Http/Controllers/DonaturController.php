<?php

namespace App\Http\Controllers;

use App\Donatur;
use App\Laporan;
use App\Riwayat;
use App\Exports\DonaturExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DonaturController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $user = Auth::user();

        $keywordNama = $request->keywordNama;
        $keywordDaerah = $request->keywordDaerah;

        $entry = [
            'keywordNama' =>$keywordNama,
            'keywordDaerah' =>$keywordDaerah,
        ];

        if ($user->role == 4){
            $donatur = Donatur::where('fund_id', $user->id)
                ->orderBy('nama')
                ->when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('kota_kab', $request->keywordDaerah);})
                ->when($request->keywordNama != null, function ($query) use ($request) {
                    $query->where('nama', 'like', "%{$request->keywordNama}%");})
                ->paginate(10);
        }
        elseif ($user->role == 3){
            $donatur = Donatur::where( function($q) use ($user) {
                $q->where('kota_kab', $user->domisili);
            })  ->orderBy('nama')
                ->when($request->keywordNama != null, function ($query) use ($request) {
                    $query->where('nama', 'like', "%{$request->keywordNama}%");})
                ->paginate(10);
        }
        else {
            $donatur = Donatur::orderBy('nama')
                ->when($request->keywordNama != null, function ($query) use ($request) {
                    $query->where('nama', 'like', "%{$request->keywordNama}%");})
                ->when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('kota_kab', $request->keywordDaerah);})
                ->paginate(10);
        }

        $donatur->appends($request->only('keywordDaerah', 'limit'));

        return view('show.maintable', compact('donatur', 'entry'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $entry = [
            'inputTglReg' => $request->inputTglReg,
            'inputNama' => $request->inputNama,
            'inputBP' => $request->inputBP,
            'inputBOD' => $request->inputBOD,
            'inputAddress' => $request->inputAddress,
            'inputRT' => $request->inputRT,
            'inputRW' => $request->inputRW,
            'inputKodepos' => $request->inputKodepos,
            'inputKel' => $request->inputKel,
            'inputKec' => $request->inputKec,
            'inputKab' => $request->inputKab,
            'inputProv' => $request->inputProv,
            'inputNegara' => $request->inputNegara,
            'inputTelp' => $request->inputTelp,
            'inputHP' => $request->inputHP,
            'inputEmail' => $request->inputEmail,
            'inputProf' => $request->inputProf,
            'inputFB' => $request->inputFB,
            'inputIG' => $request->inputIG,
            'inputCatatan' => $request->inputCatatan,
        ];

        return view('post.buatdonatur', compact('entry'));
    }

    function generateDonaId() {
        $number = mt_rand(10000000, 99999999); // better than rand()
    
        // call the same function if the barcode exists already
        if ($this->donaIdExists($number)) {
            return generateDonaId();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    
    function donaIdExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Donatur::whereDonaId($number)->exists();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        
        $nocek = uniqid();
        $user = Auth::user();
        $donatur = new Donatur;
        
        $donatur->nama = $request->inputNama;
        $donatur->tempat_lahir = $request->inputBP;
        $donatur->tgl_lahir = $request->inputBOD;
        $donatur->alamat = $request->inputAddress;
        $donatur->rt = $request->inputRT;
        $donatur->rw = $request->inputRW;
        $donatur->kodepos = $request->inputKodepos;
        $donatur->kelurahan = $request->inputKel;
        $donatur->kecamatan = $request->inputKec;
        $donatur->kota_kab = $request->inputKab;
        $donatur->provinsi = $request->inputProv;
        $donatur->negara = $request->inputNegara;
        $donatur->no_telp = $request->inputTelp;
        $donatur->no_hp = $request->inputHP;
        $donatur->email = $request->inputEmail;
        $donatur->profesi = $request->inputProf;
        $donatur->akun_facebook = $request->inputFB;
        $donatur->akun_instagram = $request->inputIG;
        $donatur->catatan = $request->inputCatatan;
        $donatur->fund_id = $user->id;
        // dd($donatur);
        $donatur->save();

        $id = Donatur::where('id', $donatur->id)->first();

        return redirect()->action(
            'DonaturController@index', $id->id
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Donatur  $donatur
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $donatur = Donatur::where('id', $id)->first();

        return view ('show.donadata', ['donatur'=>$donatur]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Donatur  $donatur
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donatur = Donatur::where('id', $id)->first();

        $result = [
            'donatur' => $donatur,
        ];

        return view ('post.ubahdonatur', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donatur  $donatur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $donatur = Donatur::where('id', $request->id)->first();

        $donatur->nama = $request->inputNama;
        $donatur->tempat_lahir = $request->inputBP;
        $donatur->tgl_lahir = $request->inputBOD;
        $donatur->alamat = $request->inputAddress;
        $donatur->rt = $request->inputRT;
        $donatur->rw = $request->inputRW;
        $donatur->kodepos = $request->inputKodepos;
        $donatur->kelurahan = $request->inputKel;
        $donatur->kecamatan = $request->inputKec;
        $donatur->kota_kab = $request->inputKab;
        $donatur->provinsi = $request->inputProv;
        $donatur->negara = $request->inputNegara;
        $donatur->no_telp = $request->inputTelp;
        $donatur->no_hp = $request->inputHP;
        $donatur->email = $request->inputEmail;
        $donatur->profesi = $request->inputProf;
        $donatur->akun_facebook = $request->inputFB;
        $donatur->akun_instagram = $request->inputIG;
        $donatur->catatan = $request->inputCatatan;
        
        $donatur->save();

        return redirect()->action(
            'DonaturController@index', $donatur->id
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donatur  $donatur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Donatur::where('id', $id)->delete();

        return redirect()->action(
            'DonaturController@all'
        )->with('success', 'Data berhasil dihapus');
    }

    /**
     * @return BinaryFileResponse
     */
    public function export()
    {
        $user = Auth::user();

        $id = $user->id;
        $daerah = $user->domisili;

        return new DonaturExport($id, $daerah);
    }
}