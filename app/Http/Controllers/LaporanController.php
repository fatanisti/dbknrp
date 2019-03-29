<?php

namespace App\Http\Controllers;

use DB;
use App\Laporan;
use App\Riwayat;
use App\Exports\LaporanExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LaporanController extends Controller
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
        // dd(date('m'));
        // dd($request->all());
        $user = Auth::user();
        $query = $request->get('q');

        $keywordDaerah = $request->keywordDaerah;
        $keywordBulan = $request->keywordBulan;
        $keywordTahun = $request->keywordTahun;

        $entry = [
            'keywordDaerah' =>$keywordDaerah,
            'keywordBulan' =>$keywordBulan,
            'keywordTahun' =>$keywordTahun,
        ];

        if ($user->role == 1){
            $result = Laporan::when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('lap_domisili', $request->keywordDaerah)
                ;})
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('lap_tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('lap_tanggal', $request->keywordTahun)
                ;})
                ->get();

            $result2 = DB::table('laporan')
                ->select(DB::raw('lap_domisili as area, YEAR(lap_tanggal) as year, MONTH(lap_tanggal) as month'), DB::raw('sum(lap_jml) as total'))
                ->groupBy('area', 'year', 'month')
                ->when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('lap_domisili', $request->keywordDaerah)
                ;})
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('lap_tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('lap_tanggal', $request->keywordTahun)
                ;})
                ->orderBy('lap_tanggal', 'desc')
                ->simplePaginate(10);
        }
        elseif ($user->role == 3){
            $result = Laporan::where('lap_domisili', $user->domisili)
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('lap_tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('lap_tanggal', $request->keywordTahun)
                ;})
                ->get();

            $result2 = Laporan::where('lap_domisili', $user->domisili)
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('lap_tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('lap_tanggal', $request->keywordTahun)
                ;})
                ->orderBy('lap_tanggal', 'desc')
                ->simplePaginate(10);
        }
        elseif ($user->role == 4){
            $result = DB::table('riwayat_donasi')
                ->join('donatur', 'donatur.dona_id', '=', 'riwayat_donasi.user_id')
                ->where('donatur.fund_id', $user->id)
                ->when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('dona_kota_kab', $request->keywordDaerah)
                ;})
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('riwa_tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('riwa_tanggal', $request->keywordTahun)
                ;})
                ->get();

            $result2 = DB::table('riwayat_donasi')
                ->join('donatur', 'donatur.dona_id', '=', 'riwayat_donasi.user_id')
                ->where('donatur.fund_id', $user->id)
                ->when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('dona_kota_kab', $request->keywordDaerah)
                ;})
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('riwa_tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('riwa_tanggal', $request->keywordTahun)
                ;})
                ->orderBy('riwa_tanggal', 'desc')
                ->simplePaginate(10);       
        }
        else {
            $result = Laporan::when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('lap_domisili', $request->keywordDaerah)
                ;})
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('lap_tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('lap_tanggal', $request->keywordTahun)
                ;})
                ->get();

            $result2 = Laporan::when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('lap_domisili', $request->keywordDaerah)
                ;})
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('lap_tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('lap_tanggal', $request->keywordTahun)
                ;})
                ->orderBy('lap_tanggal', 'desc')
                ->simplePaginate(10);
        }

        // dd($result2->toArray());
        return view('show.laporan', compact('result', 'result2', 'query', 'entry'));
        // return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $inputTgl = $request->inputTgl;
        $inputKeg = $request->inputKeg;
        $inputNama = $request->inputNama;
        $inputKab = $request->inputKab;
        $inputDona = $request->inputDona;
        $inputJenis = $request->inputJenis;
        $inputBank = $request->inputBank;

        $entry = [
            'inputTgl' =>$inputTgl,
            'inputKeg' =>$inputKeg,
            'inputNama' =>$inputNama,
            'inputKab' =>$inputKab,
            'inputDona' =>$inputDona,
            'inputJenis' =>$inputJenis,
            'inputBank' =>$inputBank,
        ];

        return view('post.inputdonasi', compact('entry'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $laporan = new Laporan;
        $nocek = uniqid();

        $laporan->lap_id = $nocek;
        $laporan->lap_tanggal = $request->inputTgl;
        $laporan->lap_kegiatan = $request->inputKeg;
        $laporan->lap_penerima = $user->nama;
        if ($user->id == 2){
            $laporan->lap_domisili = $request->inputKab;
        }
        else {
            $laporan->lap_domisili = $user->domisili;
        }
        $laporan->lap_pemberi = $request->inputNama;
        $laporan->lap_asal = $request->inputKab;
        $laporan->lap_jml = $request->inputDona;
        $laporan->lap_jenis = $request->inputJenis;
        if ($request->inputJenis == "Transfer"){
            $laporan->lap_bank = $request->inputBank;
        }
        $laporan->save();

        return redirect()->action(
            'LaporanController@index'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Laporan::where('lap_id', $id)->first()){
            // It exists
            Laporan::where('lap_id', $id)->delete();
        }
        else{
            // It does not exist
        }

        if (Riwayat::where('riwa_id', $id)->first()){
            // It exists
            Riwayat::where('riwa_id', $id)->delete();
        }
        else{
            // It does not exist
        }

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    /**
     * @return BinaryFileResponse
     */
    public function export()
    {
        return new LaporanExport();
    }
}