<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table = "riwayat_donasi";

    protected $fillable = [
        'riwa_tanggal',
        'riwa_penerima',
        'riwa_domisili',
        'riwa_pemberi',
        'riwa_asal',
        'riwa_jml',
        'riwa_jenis',
        'riwa_bank',
    ];

    protected $primaryKey = 'riwa_id';
    public $timestamps = false;
    public $incrementing = false;
}
