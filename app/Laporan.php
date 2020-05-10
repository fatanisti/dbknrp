<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = "laporan";

    protected $fillable = [
        'tanggal',
        'kegiatan',
        'penerima',
        'domisili',
        'pemberi',
        'asal',
        'jml',
        'jenis',
        'bank',
    ];

    protected $primaryKey = 'id';
    public $incrementing = false;
}
