<?php

namespace App\Http\Controllers;

use App\User;
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

        $generateuser = $this->random_username($request->inputNama);
        $generatepass = $this->random_string();
        
        $akun = [
            'username' => $generateuser,
            'password' => $generatepass,
        ];

        $user = User::create([
            'username' => $generateuser,
            'password' => Hash::make($generatepass),
            'nama' => $request->inputNama,
            'domisili' => $request->inputDomi,
            'no_hp' => $request->inputHP,
            'email' => $request->inputEmail,
            'role' => $request->inputRole,
            'remember_token' => str_random(10),
            ]);
        
        return redirect()->action(
            'AdminController@giveacc', $akun
        );
    }

    public function giveacc(Request $request){
        return view ('storeadmin', compact('request'));
    }

    function random_username($string) {
        $firstpart = substr(str_replace(" ", "", $string),0,5);
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

    public function manageAcc(){
        $user = Auth::user();

        if ($user->role == 1){
            $mamas = User::where('id', 2)
                ->orderBy('nama')
                ->paginate(10);
        }
        elseif ($user->role == 2){
            $mamas = User::where('id', 3)
                ->orWhere('id', 4)
                ->orderBy('nama')
                ->paginate(10);
        }
        else {
            $mamas = User::where('id', 4)
                ->orderBy('nama')
                ->paginate(10);
        }

        return view ('manacc', compact('mamas'));
    }

    public function infoAcc($id){

        $admin = User::where('id', $id)->first();

        return view ('infoacc', compact('admin'));
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->action(
            'AdminController@manageAcc'
        );
    }
}
