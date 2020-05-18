<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = "dona_calon";
    protected $fillable = [
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
        'profesi',
        'isNew',
    ];

    protected $primaryKey = 'id';
    public $incrementing = false;
}