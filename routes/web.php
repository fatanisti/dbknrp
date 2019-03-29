<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', function () {
    if(Auth::check()) {
        return redirect()->route('home');
    }
    return view('landing');
});

Route::group(['middleware' => 'disablepreventback'],function()
{
    Auth::routes();
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/daftar_donatur', 'DonaturController@all')->name('dona_data');
    Route::get('/data_donatur/{id}', 'DonaturController@index')->name('donatur/{id}');
    Route::get('/riwayat_donasi/{id}', 'RiwayatController@index')->name('riwayat/{id}');
    Route::get('/laporan', 'LaporanController@index')->name('dona_laporan');

    Route::get('/daftar_donatur/data_donatur/download', 'DonaturController@export')->name('unduh_dona');
    Route::get('/daftar_donatur/data_donatur/download', 'RiwayatController@export')->name('unduh_riwa');
    Route::get('/laporan/download', 'LaporanController@export')->name('unduh_lap');

    Route::get('/tambah_donatur', 'DonaturController@create')->name('create_dona')->middleware('check-permission:adminFR');
    Route::post('/simpan_donatur', 'DonaturController@store')->name('store_dona')->middleware('check-permission:adminFR');
    Route::get('/ubah_donatur/{id}', 'DonaturController@edit')->name('edit_dona/{id}')->middleware('check-permission:adminDaerah|adminFR');
    Route::post('/perbarui_donatur', 'DonaturController@update')->name('update_dona')->middleware('check-permission:adminDaerah|adminFR');
    Route::post('/hapus_donatur/{id}', 'DonaturController@destroy')->name('delete_dona/{id}')->middleware('check-permission:adminDaerah|adminFR');

    Route::post('/simpan_riwayat/{id}', 'RiwayatController@store')->name('store_riwa/{id}')->middleware('check-permission:adminMaker|adminDaerah|adminFR');
    Route::post('/hapus_riwayat/{id}', 'RiwayatController@destroy')->name('del_riwa/{id}')->middleware('check-permission:adminMaker|adminDaerah|adminFR');

    Route::get('/tambah_donasi', 'LaporanController@create')->name('create_lap')->middleware('check-permission:adminMaker|adminDaerah');
    Route::post('/simpan_donasi', 'LaporanController@store')->name('store_lap')->middleware('check-permission:adminMaker|adminDaerah');
    Route::get('/hapus_donasi/{id}', 'LaporanController@destroy')->name('del_lap/{id}')->middleware('check-permission:adminMaker|adminDaerah|adminFR');

    Route::get('/ganti_password', 'AdminController@changePass')->name('change_pass');
    Route::post('/update_password', 'AdminController@storePass')->name('store_pass');

    Route::get('/tambah_akun', 'AdminController@index')->name('create_acc')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
    Route::post('/simpan_akun', 'AdminController@create')->name('store_acc')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
    Route::get('/tambah_akun_sukses', 'AdminController@giveacc')->name('give_acc')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
    Route::get('/kelola_akun', 'AdminController@manageAcc')->name('manage_acc')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
    Route::get('/info_akun/{id}', 'AdminController@infoAcc')->name('info_acc/{id}')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
    Route::post('/reset_akun/{id}', 'AdminController@resetPass')->name('reset_pass/{id}')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
    Route::get('/reset_akun_sukses', 'AdminController@resetacc')->name('reset_acc')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
    Route::post('/hapus_akun/{id}', 'AdminController@destroy')->name('delete_acc/{id}')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');

    Route::get('/cek_permohonan_gabung', 'GuestController@show')->name('show_req')->middleware('check-permission:adminFR');
    Route::post('/terima_permohonan/{id}', 'GuestController@accept')->name('acc_req/{id}')->middleware('check-permission:adminFR');
    Route::post('/tolak_permohonan/{id}', 'GuestController@ignore')->name('ign_req/{id}')->middleware('check-permission:adminFR');
});

Route::get('/calon_donatur', 'GuestController@create')->name('buat_dona');
Route::post('/save_donatur', 'GuestController@store')->name('spn_dona');