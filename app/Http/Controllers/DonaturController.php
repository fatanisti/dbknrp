<?php

namespace App\Http\Controllers;

use App\Donatur;
use App\Laporan;
use App\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index(Request $request)
    {
        $user = Auth::user();

        $entry = [
            'keywordDaerah' => $request->keywordDaerah,
        ];

        if ($user->role == 4){
            $donatur = Donatur::where('fund_id', $user->id)
                ->orderBy('dona_nama')
                ->when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('dona_kota_kab', $request->keywordDaerah);})
                ->paginate(10);
        }
        elseif ($user->role == 3){
            $donatur = Donatur::where('dona_kota_kab', $user->domisili)
                ->orderBy('dona_nama')
                ->paginate(10);
        }
        else {
            $donatur = Donatur::orderBy('dona_nama')
                ->when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('dona_kota_kab', $request->keywordDaerah);})
                ->paginate(10);
        }

        $donatur->appends($request->only('keywordDaerah', 'limit'));

        return view('maintable', compact('donatur', 'entry'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $idDon = $this->generateDonaId();

        $entry = [
            'idDon' => $idDon,
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
            'inputDona' => $request->inputDona,
            'inputJenis' => $request->inputJenis,
            'inputBank' => $request->inputBank,
            'inputCatatan' => $request->inputCatatan,
        ];

        return view('createdonatur', compact('entry'));
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
        
        $donatur->dona_id = $request->idDon;
        $donatur->dona_tgl_regis = $request->inputTglReg;
        $donatur->dona_nama = $request->inputNama;
        $donatur->dona_tempat_lahir = $request->inputBP;
        $donatur->dona_tgl_lahir = $request->inputBOD;
        $donatur->dona_alamat = $request->inputAddress;
        $donatur->dona_rt = $request->inputRT;
        $donatur->dona_rw = $request->inputRW;
        $donatur->dona_kodepos = $request->inputKodepos;
        $donatur->dona_kelurahan = $request->inputKel;
        $donatur->dona_kecamatan = $request->inputKec;
        $donatur->dona_kota_kab = $request->inputKab;
        $donatur->dona_provinsi = $request->inputProv;
        $donatur->dona_negara = $request->inputNegara;
        $donatur->dona_no_telp = $request->inputTelp;
        $donatur->dona_no_hp = $request->inputHP;
        $donatur->dona_email = $request->inputEmail;
        $donatur->dona_profesi = $request->inputProf;
        $donatur->dona_akun_facebook = $request->inputFB;
        $donatur->dona_akun_instagram = $request->inputIG;
        $donatur->dona_catatan = $request->inputCatatan;
        $donatur->fund_id = $user->id;
        // dd($donatur);
        $donatur->save();

        $id = Donatur::where('dona_id', $request->idDon)->first();

        $riwayat = new Riwayat;
    
        $riwayat->riwa_id = $nocek;
        $riwayat->riwa_tanggal = $request->inputTglReg;
        $riwayat->riwa_jml = $request->inputDona;
        $riwayat->riwa_jenis = $request->inputJenis;
        $riwayat->riwa_bank = $request->inputBank;
        $riwayat->fund_id = $user->id;
        $riwayat->user_id = $id->dona_id;
        $riwayat->save();

        $laporan = new Laporan;

        $laporan->lap_id = $nocek;
        $laporan->lap_tanggal = $request->inputTglReg;
        $laporan->lap_penerima = $user->nama;
        $laporan->lap_domisili = $user->domisili;
        $laporan->lap_pemberi = $request->inputNama;
        $laporan->lap_asal = $request->inputKab;
        $laporan->lap_jml = $request->inputDona;
        $laporan->lap_jenis = $request->inputJenis;
        $laporan->lap_bank = $request->inputBank;

        $laporan->save();

        return redirect()->action(
            'DonaturController@show', $id->dona_id
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Donatur  $donatur
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donatur = Donatur::where('dona_id', $id)->first();

        return view ('donadata', ['donatur'=>$donatur]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Donatur  $donatur
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donatur = Donatur::where('dona_id', $id)->first();

        $result = [
            'donatur' => $donatur,
        ];

        return view ('createdonatur', $result);
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
        $donatur = Donatur::where('dona_id', $request->idDon)->first();

        $donatur->dona_nama = $request->inputNama;
        $donatur->dona_tempat_lahir = $request->inputBP;
        $donatur->dona_tgl_lahir = $request->inputBOD;
        $donatur->dona_alamat = $request->inputAddress;
        $donatur->dona_rt = $request->inputRT;
        $donatur->dona_rw = $request->inputRW;
        $donatur->dona_kodepos = $request->inputKodepos;
        $donatur->dona_kelurahan = $request->inputKel;
        $donatur->dona_kecamatan = $request->inputKec;
        $donatur->dona_kota_kab = $request->inputKab;
        $donatur->dona_provinsi = $request->inputProv;
        $donatur->dona_negara = $request->inputNegara;
        $donatur->dona_no_telp = $request->inputTelp;
        $donatur->dona_no_hp = $request->inputHP;
        $donatur->dona_email = $request->inputEmail;
        $donatur->dona_profesi = $request->inputProf;
        $donatur->dona_akun_facebook = $request->inputFB;
        $donatur->dona_akun_instagram = $request->inputIG;
        $donatur->dona_catatan = $request->inputCatatan;
        
        $donatur->save();

        return redirect()->action(
            'DonaturController@show', $donatur->dona_id
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
        Donatur::where('dona_id', $id)->delete();

        return redirect()->action(
            'HomeController@index'
        );
    }
}
