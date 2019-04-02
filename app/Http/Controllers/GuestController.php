<?php

namespace App\Http\Controllers;

use App\Donatur;
use App\Riwayat;
use App\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function create(Request $request)
    {
        $entry = [
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
        ];
        return view('post.jadidonatur', compact('entry'));
    }

    function generateDonaId()
    {
        $number = mt_rand(10000000, 99999999); // better than rand()
    
        // call the same function if the barcode exists already
        if ($this->donaIdExists($number)) {
            return generateDonaId();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    
    function donaIdExists($number)
    {
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
        $idDon = $this->generateDonaId();

        $donatur = new Guest;

        $donatur->dona_id = $idDon;
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
        // dd($donatur);
        $donatur->save();

        return redirect()->back()->with('success', 'Form berhasil dikirim. Permintaan anda akan segera diproses! Terima kasih.');
    }

    public function show(Request $request)
    {
        $entry = [
            'keywordDaerah' => $request->keywordDaerah,
        ];
        
        $result = Guest::orderBy('created_at')
            ->when($request->keywordDaerah != null, function ($query) use ($request) {
                $query->where('dona_kota_kab', $request->keywordDaerah);})
            ->paginate(10);
        
        return view('show.donarequ', compact('result', 'entry'));
    }

    public function accept($id)
    {
        $caldon = Guest::where('dona_id', $id)->first();
        $user = Auth::user();

        if (Donatur::where('dona_id', '=', $caldon->dona_id)->exists()){
            $donatur = Donatur::where('dona_id', $id)->first();
            $donatur->fund_id = $user->id;
            $donatur->save();
        }
        else{
            $donatur = new Donatur;
            $donatur->dona_id = $caldon->dona_id;
            $donatur->dona_tgl_regis = now();
            $donatur->dona_nama = $caldon->dona_nama;
            $donatur->dona_tempat_lahir = $caldon->dona_tempat_lahir;
            $donatur->dona_tgl_lahir = $caldon->dona_tgl_lahir;
            $donatur->dona_alamat = $caldon->dona_alamat;
            $donatur->dona_rt = $caldon->dona_rt;
            $donatur->dona_rw = $caldon->dona_rw;
            $donatur->dona_kodepos = $caldon->dona_kodepos;
            $donatur->dona_kelurahan = $caldon->dona_kelurahan;
            $donatur->dona_kecamatan = $caldon->dona_kecamatan;
            $donatur->dona_kota_kab = $caldon->dona_kota_kab;
            $donatur->dona_provinsi = $caldon->dona_provinsi;
            $donatur->dona_negara = $caldon->dona_negara;
            $donatur->dona_no_telp = $caldon->dona_no_telp;
            $donatur->dona_no_hp = $caldon->dona_no_hp;
            $donatur->dona_email = $caldon->dona_email;
            $donatur->dona_profesi = $caldon->dona_profesi;
            $donatur->dona_akun_facebook = $caldon->dona_akun_facebook;
            $donatur->dona_akun_instagram = $caldon->dona_akun_instagram;
            $donatur->dona_catatan = null;
            $donatur->fund_id = $user->id;
            // dd($donatur);
            $donatur->save();
        }

        Guest::where('dona_id', $id)->delete();

        return redirect()->back()->with('success', 'Donatur berhasil ditambahkan');
    }

    public function ignore($id)
    {
        if (Donatur::where('dona_id', '=', $id)->exists()){
            Donatur::where('dona_id', $id)->delete();
        }

        if (Riwayat::where('user_id', '=', $id)->exists()){
            Riwayat::where('user_id', $id)->delete();
        }

        Guest::where('dona_id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}