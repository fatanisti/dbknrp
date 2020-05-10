<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table = "dona_riwa";

    protected $fillable = [
        'tanggal',
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
