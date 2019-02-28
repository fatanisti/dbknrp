<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    protected $table = "donatur";

    protected $fillable = [
        'dona_tgl_regis',
        'dona_nama',
        'dona_tempat_lahir', 
        'dona_tgl_lahir', 
        'dona_alamat', 
        'dona_rt',
        'dona_rw',
        'dona_kodepos',
        'dona_kelurahan',
        'dona_kecamatan',
        'dona_kota_kab',
        'dona_provinsi',
        'dona_negara',
        'dona_no_telp',
        'dona_no_hp',
        'dona_email',
        'dona_akun_facebook',
        'dona_akun_instagram',
        'dona_profesi',
        'dona_catatan',
    ];

    protected $primaryKey = 'dona_id';
    public $incrementing = false;
}