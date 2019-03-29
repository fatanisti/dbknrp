<?php

namespace App\Http\Controllers;

use DB;
use App\Donatur;
use App\Laporan;
use App\Riwayat;
use App\Exports\RiwayatExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RiwayatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
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
            ->where('user_id', $id)
            ->orderBy('riwa_tanggal', 'desc')
            ->when($request->keywordBulan != null, function ($query) use ($request) {
                $query->whereMonth('riwa_tanggal', $request->keywordBulan);})
            ->when($request->keywordTahun != null, function ($query) use ($request) {
                $query->whereYear('riwa_tanggal', $request->keywordTahun);})
            ->paginate(10);

        return view('show.donariwa', compact('entry', 'riwayat', 'donatur'));
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
        $riwayat->riwa_penerima = $user->nama;
        $riwayat->riwa_domisili = $user->domisili;
        $riwayat->riwa_pemberi = $dona->dona_nama;
        $riwayat->riwa_asal = $dona->dona_kota_kab;
        $riwayat->riwa_jml = $request->inputDona;
        $riwayat->riwa_jenis = $request->inputJenis;
        if ($request->inputJenis == "Transfer"){
            $riwayat->riwa_bank = $request->inputBank;
        }
        $riwayat->user_id = $id;
        $riwayat->save();

        $laporan = new Laporan;

        $laporan->lap_id = $nocek;
        $laporan->lap_tanggal = $request->inputTgl;
        $laporan->lap_kegiatan = "Donasi Reguler";
        $laporan->lap_penerima = $user->nama;
        $laporan->lap_domisili = $user->domisili;
        $laporan->lap_pemberi = $dona->dona_nama;
        $laporan->lap_asal = $dona->dona_kota_kab;
        $laporan->lap_jml = $request->inputDona;
        $laporan->lap_jenis = $request->inputJenis;
        if ($request->inputJenis == "Transfer"){
            $laporan->lap_bank = $request->inputBank;
        }
        $laporan->save();

        return redirect()->action(
            'RiwayatController@index', $id
        );
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

        return redirect()->back()->with('success', 'Data berhasil dihapus');        
    }

     /**
     * @return BinaryFileResponse
     */
    public function export()
    {
        $user = Auth::user();

        $id = $user->id;

        return new RiwayatExport($id);
    }
}
