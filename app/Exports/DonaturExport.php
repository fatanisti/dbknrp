<?php

namespace App\Exports;

use App\Donatur;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DonaturExport implements FromQuery, WithHeadings, Responsable, ShouldAutoSize
{
    use Exportable;

    private $fileName = 'data-donatur.xlsx';

    public function __construct(string $id, string $daerah)
    {
        $this->id = $id;
        $this->daerah = $daerah;
    }

    public function query()
    {
        $user = Auth::user();

        if ($user->role == 4){
            return Donatur::query()
            ->where('fund_id', $this->id);
        }
        elseif ($user->role == 3){
            return Donatur::query()
            ->where('dona_kota_kab', $this->daerah);
        }
        else {
            return Donatur::query();
        }
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Donatur',
            'Tgl Regis',
            'Nama',
            'Tempat Lahir',
            'Tgl Lahir',
            'Alamat',
            'RT',
            'RW',
            'Kodepos',
            'Kelurahan',
            'Kecamatan',
            'Kota/Kab',
            'Provinsi',
            'Negara',
            'No. Telp',
            'No. HP',
            'Email',
            'Akun Facebook',
            'Akun Instagram',
            'Profesi',
            'Catatan',
        ];
    }
}
