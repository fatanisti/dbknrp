<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = "laporan";

    protected $fillable = [
        'lap_tanggal',
        'lap_penerima',
        'lap_domisili',
        'lap_pemberi',
        'lap_asal',
        'lap_jml',
        'lap_jenis',
        'lap_bank',
    ];

    protected $primaryKey = 'lap_id';
    public $timestamps = false;
    public $incrementing = false;
}
