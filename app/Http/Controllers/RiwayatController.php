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

        $donatur = Donatur::where('id', $id)->first();
        $riwayat = DB::table('dona_riwa')
            ->join('dona_profile', 'dona_profile.id', '=', 'dona_riwa.dona_id')
            ->where('dona_id', $id)
            ->orderBy('tanggal', 'desc')
            ->when($request->keywordBulan != null, function ($query) use ($request) {
                $query->whereMonth('tanggal', $request->keywordBulan);})
            ->when($request->keywordTahun != null, function ($query) use ($request) {
                $query->whereYear('tanggal', $request->keywordTahun);})
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
        $dona = Donatur::where('id', $id)->first();
        $nocek = uniqid();

        $riwayat = new Riwayat;

        $riwayat->id = $nocek;
        $riwayat->tanggal = $request->inputTgl;
        $riwayat->penerima = $user->profile->nama;
        $riwayat->domisili = $user->profile->domisili;
        $riwayat->pemberi = $dona->nama;
        $riwayat->asal = $dona->kota_kab;
        $riwayat->jml = $request->inputDona;
        $riwayat->jenis = $request->inputJenis;
        if ($request->inputJenis == "Transfer"){
            $riwayat->bank = $request->inputBank;
        }
        $riwayat->dona_id = $id;
        $riwayat->save();

        $laporan = new Laporan;

        $laporan->id = $nocek;
        $laporan->tanggal = $request->inputTgl;
        $laporan->kegiatan = "Donasi Reguler";
        $laporan->penerima = $user->profile->nama;
        $laporan->domisili = $user->profile->domisili;
        $laporan->pemberi = $dona->nama;
        $laporan->asal = $dona->kota_kab;
        $laporan->jml = $request->inputDona;
        $laporan->jenis = $request->inputJenis;
        if ($request->inputJenis == "Transfer"){
            $laporan->bank = $request->inputBank;
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
        Riwayat::where('id', $id)->delete();
        Laporan::where('id', $id)->delete();

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
