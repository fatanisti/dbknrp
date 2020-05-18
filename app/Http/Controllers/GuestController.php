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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $donatur = new Guest;

        $donatur->id = $this->generateDonaId();
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
        $donatur->is_new = 1;
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
                $query->where('kota_kab', $request->keywordDaerah);})
            ->paginate(10);
        
        return view('show.donarequ', compact('result', 'entry'));
    }

    public function accept($id)
    {
        $caldon = Guest::where('id', $id)->first();
        $user = Auth::user();

        if ($caldon->is_new == 0){
            $donatur = Donatur::where('id', $id)->first();
            $donatur->fund_id = $user->id;
            $donatur->save();
        }
        else{
            $donatur = new Donatur;
            $donatur->nama = $caldon->nama;
            $donatur->tempat_lahir = $caldon->tempat_lahir;
            $donatur->tgl_lahir = $caldon->tgl_lahir;
            $donatur->alamat = $caldon->alamat;
            $donatur->rt = $caldon->rt;
            $donatur->rw = $caldon->rw;
            $donatur->kodepos = $caldon->kodepos;
            $donatur->kelurahan = $caldon->kelurahan;
            $donatur->kecamatan = $caldon->kecamatan;
            $donatur->kota_kab = $caldon->kota_kab;
            $donatur->provinsi = $caldon->provinsi;
            $donatur->negara = $caldon->negara;
            $donatur->no_telp = $caldon->no_telp;
            $donatur->no_hp = $caldon->no_hp;
            $donatur->email = $caldon->email;
            $donatur->profesi = $caldon->profesi;
            $donatur->akun_facebook = $caldon->akun_facebook;
            $donatur->akun_instagram = $caldon->akun_instagram;
            $donatur->catatan = null;
            $donatur->fund_id = $user->id;
            // dd($donatur);
            $donatur->save();
        }

        Guest::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Donatur berhasil ditambahkan');
    }

    public function ignore($id)
    {
        if (Donatur::where('id', '=', $id)->exists()){
            Donatur::where('id', $id)->delete();
        }

        if (Riwayat::where('dona_id', '=', $id)->exists()){
            Riwayat::where('dona_id', $id)->delete();
        }

        Guest::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    function generateDonaId() {
        $number = mt_rand(1000000000, 9999999999); // better than rand()
    
        // call the same function if the barcode exists already
        if ($this->idExists($number)) {
            return generateDonaId();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    
    function idExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Guest::whereId($number)->exists();
    }
}