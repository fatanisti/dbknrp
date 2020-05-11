<?php

namespace App\Exports;

use App\Laporan;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromQuery, WithHeadings, Responsable, ShouldAutoSize
{
    use Exportable;

    private $fileName = 'laporan-dbknrp.xlsx';

    public function query()
    {
        $user = Auth::user();

        if ($user->role == 4){
            return Laporan::query()
            ->where('penerima', $user->profile->nama);
        }
        elseif ($user->role == 3){
            return Laporan::query()
            ->where('domisili', $user->profile->domisili);
        }
        else {
            return Laporan::query();
        }
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Donasi',
            'Tanggal Terima',
            'Jenis Kegiatan',
            'Nama Penerima',
            'Domisili Penerima',
            'Nama Donatur',
            'Domisili Donatur',
            'Jumlah Donasi',
            'Jenis',
            'Bank',
        ];
    }
}