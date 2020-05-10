<?php

namespace App\Http\Controllers;

use DB;
use App\Donatur;
use App\Guest;
use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $inputRole = $request->inputRole;
        $inputDomi = $request->inputDomi;

        $entry = [
            'inputRole'=>$inputRole,
            'inputDomi'=>$inputDomi,
        ];
        return view('auth.register', compact ('entry'));
    }

    protected function create(Request $request)
    {
        // dd($request);
        $creator = Auth::user();
        $generateuser = $this->random_username($request->inputNama);
        $generatepass = $this->random_string();
        
        $akun = [
            'username' => $generateuser,
            'password' => $generatepass,
        ];

        if ($creator->role == 3){
            $user = User::create([
                'username' => $generateuser,
                'password' => Hash::make($generatepass),
                'email' => $request->inputEmail,
                'role' => $request->inputRole,
                'remember_token' => str_random(10),
                ]);
            $userProfile = new UserProfile;
            $userProfile->user_id = $user->id;
            $userProfile->nama = $request->inputNama;
            $userProfile->domisili = $creator->profile->domisili;
            $userProfile->no_hp = $request->inputHP;
            $userProfile->save();
        }
        else {
            if ($request->inputRole == 2){
                $user = User::create([
                    'username' => $generateuser,
                    'password' => Hash::make($generatepass),
                    'email' => $request->inputEmail,
                    'role' => $request->inputRole,
                    'remember_token' => str_random(10),
                    ]);
                $userProfile = new UserProfile;
                $userProfile->user_id = $user->id;
                $userProfile->nama = $request->inputNama;
                $userProfile->no_hp = $request->inputHP;
                $userProfile->save();
            }
            else {
                $user = User::create([
                    'username' => $generateuser,
                    'password' => Hash::make($generatepass),
                    'email' => $request->inputEmail,
                    'role' => $request->inputRole,
                    'remember_token' => str_random(10),
                    ]);
                $userProfile = new UserProfile;
                $userProfile->user_id = $user->id;
                $userProfile->nama = $request->inputNama;
                $userProfile->domisili = $request->inputDomi;
                $userProfile->no_hp = $request->inputHP;
                $userProfile->save();
            }
        }
        
        return redirect()->action(
            'AdminController@giveacc', $akun
        );
    }

    public function giveacc(Request $request){
        return view ('info.giveadmin', compact('request'));
    }

    function random_username($string) {
        $firstpart = substr(str_replace(" ", "", $string),0,12);
        $lower = strtolower($firstpart);
        $nrRand = rand(100, 1000);
        
        $username = trim($lower).trim($nrRand);
        return $username;
    }

    function random_string($length = 5) {
        return substr(str_shuffle(
            "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    public function changePass()
    {   
        return view ('auth.passwords.changepass');
    }

    /**
     * Validate form and submit
     *
     * @return void
     */
    public function storePass(Request $request)
    {
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'oldPass' => 'hash:' . $user->password,
            'newPass' => 'required|min:5|confirmed',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }

        $user->password = Hash::make($request->newPass);
        $user->save();
            
        return redirect()->back()->with('success', 'Password telah diganti');
    }

    public function resetPass($id)
    {
        $generatepass = $this->random_string();
        
        $admin = User::where('id', $id)->first();

        $akun = [
            'username' => $admin->username,
            'password' => $generatepass,
        ];

        $admin->password = Hash::make($generatepass);
        $admin->save();
            
        return redirect()->action(
            'AdminController@resetacc', $akun
        );
    }

    public function resetacc(Request $request){
        return view ('info.resetadmin', compact('request'));
    }

    public function manageAcc(){
        $user = Auth::user();

        if ($user->role == 1){
            $mamas = DB::table('users')
                ->join('users_profile', 'users.id', '=', 'users_profile.user_id')
                ->where('role', 2)
                ->orderBy('nama')
                ->paginate(10);
        }
        elseif ($user->role == 2){
            $mamas = DB::table('users')
                ->join('users_profile', 'users.id', '=', 'users_profile.user_id')
                ->where( function($q) {
                    $q->where('role', 3)
                    ->orWhere('role', 4);
                }) 
                ->orderBy('nama')
                ->paginate(10);
        }
        else {
            $mamas = DB::table('users')
                ->join('users_profile', 'users.id', '=', 'users_profile.user_id')
                ->where('role', 4)
                ->where('domisili', $user->domisili)
                ->orderBy('nama')
                ->paginate(10);
        }

        return view ('show.manacc', compact('mamas'));
    }

    public function infoAcc($id){

        $admin = User::where('id', $id)->first();

        return view ('show.infoacc', compact('admin'));
    }

    public function destroy($id)
    {
        $data = Donatur::select(
            'id',
            'nama',
            'tempat_lahir',
            'tgl_lahir',
            'alamat',
            'rt',
            'rw',
            'kodepos',
            'kelurahan',
            'kecamatan',
            'kota_kab',
            'provinsi',
            'negara',
            'no_telp',
            'no_hp',
            'email',
            'akun_facebook',
            'akun_instagram',
            'profesi')->where('fund_id', $id)->get()->toArray();
        
        Guest::insert($data);
        User::where('id', $id)->delete();
        Donatur::where('fund_id', $id)->update(array('fund_id' => null));

        return redirect()->action(
            'AdminController@manageAcc'
        )->with('success', 'Admin telah dihapus');
    }
}
