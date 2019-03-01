<?php

namespace App\Http\Controllers;

use DB;
use App\Donatur;
use App\Laporan;
use App\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
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
        $query = $request->get('q');

        $keywordNama = $request->keywordNama;
        $keywordDaerah = $request->keywordDaerah;

        $entry = [
            'keywordNama' =>$keywordNama,
            'keywordDaerah' =>$keywordDaerah,
        ];

        if ($user->role == 4){
            $donatur = Donatur::where('fund_id', $user->id)
                ->orderBy('dona_nama')
                ->when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('dona_kota_kab', $request->keywordDaerah);})
                ->when($request->keywordNama != null, function ($query) use ($request) {
                    $query->where('dona_nama', 'like', "%{$request->keywordNama}%");})
                ->paginate(10);       
        }
        elseif ($user->role == 3){
            $donatur = Donatur::where('dona_kota_kab', $user->domisili)
                ->orderBy('dona_nama')
                ->when($request->keywordNama != null, function ($query) use ($request) {
                    $query->where('dona_nama', 'like', "%{$request->keywordNama}%");})
                ->paginate(10);
        }
        else{
            $donatur = Donatur::orderBy('dona_nama')
                ->when($request->keywordNama != null, function ($query) use ($request) {
                    $query->where('dona_nama', 'like', "%{$request->keywordNama}%");})
                ->when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('dona_kota_kab', $request->keywordDaerah);})
                ->paginate(10);
        }

        return view('maintable', compact('donatur', 'query', 'entry'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $user = Auth::user();
        $dona = Donatur::where('dona_id', $id)->first();
        $nocek = uniqid();

        $riwayat = new Riwayat;

        $riwayat->riwa_id = $nocek;
        $riwayat->riwa_tanggal = $request->inputTgl;
        $riwayat->riwa_jml = $request->inputDona;
        $riwayat->riwa_jenis = $request->inputJenis;
        if ($request->inputJenis == "Transfer"){
            $riwayat->riwa_bank = $request->inputBank;
        }
        $riwayat->fund_id = $user->id;
        $riwayat->user_id = $id;
        $riwayat->save();

        $laporan = new Laporan;

        $laporan->lap_id = $nocek;
        $laporan->lap_tanggal = $request->inputTgl;
        $laporan->lap_penerima = $user->nama;
        $laporan->lap_domisili = $user->domisili;
        $laporan->lap_pemberi = $dona->dona_nama;
        $laporan->lap_asal = $dona->dona_kota_kab;
        $laporan->lap_jml = $request->inputDona;
        $laporan->lap_jenis = $request->inputJenis;
        $laporan->lap_bank = $request->inputBank;
        $laporan->save();

        return redirect()->action(
            'RiwayatController@show', $id
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $query = $request->get('q');
        
        $keywordBulan = $request->keywordBulan;
        $keywordTahun = $request->keywordTahun;

        $entry = [
            'keywordBulan' => $keywordBulan,
            'keywordTahun' => $keywordTahun,
        ];

        $donatur = Donatur::where('dona_id', $id)->first();
        $riwayat = DB::table('riwayat_donasi')
            ->join('donatur', 'donatur.dona_id', '=', 'riwayat_donasi.user_id')
            ->join('users', 'users.id', '=', 'riwayat_donasi.fund_id')
            ->where('user_id', $id)
            ->orderBy('riwa_tanggal')
            ->when($request->keywordBulan != null, function ($query) use ($request) {
                $query->whereMonth('riwa_tanggal', $request->keywordBulan);})
            ->when($request->keywordTahun != null, function ($query) use ($request) {
                $query->whereYear('riwa_tanggal', $request->keywordTahun);})
            ->paginate(10);

        return view('donariwa', compact('entry', 'riwayat', 'donatur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function edit(Riwayat $riwayat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Riwayat $riwayat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Riwayat::where('riwa_id', $id)->delete();
        Laporan::where('lap_id', $id)->delete();

        return redirect()->action(
            'HomeController@index'
        );
    }
}
