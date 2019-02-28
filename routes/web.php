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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/list_donatur', 'DonaturController@index')->name('dona_data')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
Route::get('/data_donatur/{id}', 'DonaturController@show')->name('donatur/{id}');
Route::get('/list_donasi', 'RiwayatController@index')->name('dona_riwa')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
Route::get('/riwayat_donasi/{id}', 'RiwayatController@show')->name('riwayat/{id}');
Route::get('/laporan', 'LaporanController@index')->name('dona_laporan')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');

Route::get('/tambah_donatur', 'DonaturController@create')->name('create_dona')->middleware('check-permission:adminDaerah|adminFR');
Route::post('/simpan_donatur', 'DonaturController@store')->name('store_dona')->middleware('check-permission:adminDaerah|adminFR');
Route::get('/ubah_donatur/{id}', 'DonaturController@edit')->name('edit_dona/{id}')->middleware('check-permission:adminDaerah|adminFR');
Route::post('/perbarui_donatur', 'DonaturController@update')->name('update_dona')->middleware('check-permission:adminDaerah|adminFR');
Route::post('/hapus_donatur/{id}', 'DonaturController@destroy')->name('delete_dona/{id}')->middleware('check-permission:adminDaerah|adminFR');

Route::post('/simpan_riwayat/{id}', 'RiwayatController@store')->name('store_riwa/{id}')->middleware('check-permission:adminDaerah|adminFR');
Route::get('/hapus_riwayat/{id}', 'RiwayatController@destroy')->name('del_riwa/{id}')->middleware('check-permission:adminDaerah|adminFR');

Route::get('/tambah_donasi', 'LaporanController@create')->name('create_lap')->middleware('check-permission:adminMaker|adminDaerah');
Route::post('/simpan_donasi', 'LaporanController@store')->name('store_lap')->middleware('check-permission:adminMaker|adminDaerah');
Route::get('/hapus_donasi/{id}', 'LaporanController@destroy')->name('del_lap/{id}')->middleware('check-permission:adminDaerah|adminFR');

Route::get('/list_donatur_fr', 'DonaturController@indexFundraiser')->name('dona_data_fr')->middleware('check-permission:adminFR');
Route::get('/list_donasi_fr', 'RiwayatController@indexFundraiser')->name('dona_riwa_fr')->middleware('check-permission:adminFR');
Route::get('/laporan_fr', 'LaporanController@indexFundraiser')->name('dona_laporan_fr')->middleware('check-permission:adminFR');

Route::get('/ganti_password', 'AdminController@changePass')->name('change_pass');
Route::post('/update_password', 'AdminController@storePass')->name('store_pass');

Route::get('/tambah_akun', 'AdminController@index')->name('create_acc')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
Route::post('/simpan_akun', 'AdminController@create')->name('store_acc')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
Route::get('/tambah_akun_sukses', 'AdminController@giveacc')->name('give_acc')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
Route::get('/kelola_akun', 'AdminController@manageAcc')->name('manage_acc')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
Route::get('/info_akun/{id}', 'AdminController@infoAcc')->name('info_acc/{id}')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');
Route::post('/hapus_akun/{id}', 'AdminController@destroy')->name('delete_acc/{id}')->middleware('check-permission:adminUtama|adminMaker|adminDaerah');