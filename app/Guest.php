<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = "donatur_g";
    protected $fillable = [
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
    ];

    protected $primaryKey = 'dona_id';
    public $incrementing = false;
}