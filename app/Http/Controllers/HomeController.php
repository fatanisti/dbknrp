<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 3){
            $riwa = DB::table('laporan')
                ->where('lap_domisili', $user->domisili)
                ->get();
            $dona = DB::table('donatur')
                ->join('users', 'users.id', '=', 'donatur.fund_id')
                ->where('domisili', $user->domisili)
                ->get();
            $fund = DB::table('users')->where('role', 4)
                ->where('domisili', $user->domisili)
                ->get();
            $mon = DB::table('laporan')->where('lap_domisili', $user->domisili)->sum('lap_jml');

            $monk = $this->custom_number_format($mon);
        }
        elseif ($user->role == 4){
            $riwa = DB::table('laporan')
                ->where('lap_penerima', $user->nama)
                ->get();
            $dona = DB::table('donatur')
                ->where('fund_id', $user->id)
                ->get();
            $fund = DB::table('users')->where('role', 4)
                ->where('id', $user->id)
                ->get();
            $mon = DB::table('laporan')->where('lap_penerima', $user->nama)->sum('lap_jml');

            $monk = $this->custom_number_format($mon);
        }
        else {
            $riwa = DB::table('laporan')
                ->get();
            $dona = DB::table('donatur')
                ->get();
            $fund = DB::table('users')->where('role', 4)
                ->get();
            $mon = DB::table('laporan')->sum('lap_jml');

            $monk = $this->custom_number_format($mon);
        }

        return view('show.home', compact('riwa', 'dona', 'fund', 'monk'));
    }

    function custom_number_format($n) {
        if ($n < 1000) {
            // Anything less than a thousand
            $n_format = number_format($n);
        } else if ($n < 1000000) {
            // Anything less than a million
            $n_format = number_format($n / 1000) . ' Ribu';
        } else if ($n < 1000000000) {
            // Anything less than a billion
            $n_format = number_format($n / 1000000) . ' Juta';
        } else {
            // At least a billion
            $n_format = number_format($n / 1000000000) . ' Milyar';
        }
        return $n_format;
    }
}
