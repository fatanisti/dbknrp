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
                ->where('domisili', $user->profile->domisili)
                ->get();
            $dona = DB::table('dona_profile')
                ->join('users', 'users.id', '=', 'dona_profile.fund_id')
                ->join('users_profile', 'users.id', '=', 'users_profile.user_id')
                ->where('domisili', $user->profile->domisili)
                ->get();
            $fund = DB::table('users')->where('role', 4)
                ->join('users_profile', 'users.id', '=', 'users_profile.user_id')
                ->where('domisili', $user->profile->domisili)
                ->get();
            $mon = DB::table('laporan')->where('domisili', $user->profile->domisili)->sum('jml');

            $monk = $this->custom_number_format($mon);
        }
        elseif ($user->role == 4){
            $riwa = DB::table('laporan')
                ->where('penerima', $user->nama)
                ->get();
            $dona = DB::table('dona_profile')
                ->where('fund_id', $user->id)
                ->get();
            $fund = DB::table('users')->where('role', 4)
                ->where('id', $user->id)
                ->get();
            $mon = DB::table('laporan')->where('penerima', $user->nama)->sum('jml');

            $monk = $this->custom_number_format($mon);
        }
        else {
            $riwa = DB::table('laporan')
                ->get();
            $dona = DB::table('dona_profile')
                ->get();
            $fund = DB::table('users')->where('role', 4)
                ->get();
            $mon = DB::table('laporan')->sum('jml');

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
