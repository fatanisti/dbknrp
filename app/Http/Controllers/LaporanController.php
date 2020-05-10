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
                    $query->where('domisili', $request->keywordDaerah)
                ;})
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('tanggal', $request->keywordTahun)
                ;})
                ->get();

            $result2 = DB::table('laporan')
                ->select(DB::raw('domisili as area, YEAR(tanggal) as year, MONTH(tanggal) as month'), DB::raw('sum(jml) as total'))
                ->groupBy('area', 'year', 'month')
                ->when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('domisili', $request->keywordDaerah)
                ;})
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('tanggal', $request->keywordTahun)
                ;})
                ->orderBy('tanggal', 'desc')
                ->simplePaginate(10);
        }
        elseif ($user->role == 3){
            $result = Laporan::where('domisili', $user->domisili)
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('tanggal', $request->keywordTahun)
                ;})
                ->get();

            $result2 = Laporan::where('domisili', $user->domisili)
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('tanggal', $request->keywordTahun)
                ;})
                ->orderBy('tanggal', 'desc')
                ->simplePaginate(10);
        }
        elseif ($user->role == 4){
            $result = DB::table('dona_riwa')
                ->join('dona_profile', 'dona_profile.dona_id', '=', 'dona_riwa.user_id')
                ->where('dona_profile.fund_id', $user->id)
                ->when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('kota_kab', $request->keywordDaerah)
                ;})
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('tanggal', $request->keywordTahun)
                ;})
                ->get();

            $result2 = DB::table('dona_riwa')
                ->join('dona_profile', 'dona_profile.dona_id', '=', 'dona_riwa.user_id')
                ->where('dona_profile.fund_id', $user->id)
                ->when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('kota_kab', $request->keywordDaerah)
                ;})
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('tanggal', $request->keywordTahun)
                ;})
                ->orderBy('tanggal', 'desc')
                ->simplePaginate(10);       
        }
        else {
            $result = Laporan::when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('domisili', $request->keywordDaerah)
                ;})
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('tanggal', $request->keywordTahun)
                ;})
                ->get();

            $result2 = Laporan::when($request->keywordDaerah != null, function ($query) use ($request) {
                    $query->where('domisili', $request->keywordDaerah)
                ;})
                ->when($request->keywordBulan != null, function ($query) use ($request) {
                    $query->whereMonth('tanggal', $request->keywordBulan)
                ;})
                ->when($request->keywordTahun != null, function ($query) use ($request) {
                    $query->whereYear('tanggal', $request->keywordTahun)
                ;})
                ->orderBy('tanggal', 'desc')
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

        $laporan->id = $nocek;
        $laporan->tanggal = $request->inputTgl;
        $laporan->kegiatan = $request->inputKeg;
        $laporan->penerima = $user->nama;
        if ($user->id == 2){
            $laporan->domisili = $request->inputKab;
        }
        else {
            $laporan->domisili = $user->domisili;
        }
        $laporan->pemberi = $request->inputNama;
        $laporan->asal = $request->inputKab;
        $laporan->jml = $request->inputDona;
        $laporan->jenis = $request->inputJenis;
        if ($request->inputJenis == "Transfer"){
            $laporan->bank = $request->inputBank;
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
        if (Laporan::where('id', $id)->first()){
            // It exists
            Laporan::where('id', $id)->delete();
        }
        else{
            // It does not exist
        }

        if (Riwayat::where('id', $id)->first()){
            // It exists
            Riwayat::where('id', $id)->delete();
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