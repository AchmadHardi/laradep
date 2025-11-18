<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Siswa::with('lembaga')->get();
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama',
            'Email',
            'Lembaga',
            'Foto'
        ];
    }

    public function map($siswa): array
    {
        return [
            $siswa->nis,
            $siswa->nama,
            $siswa->email,
            $siswa->lembaga->nama_lembaga ?? '-',
            $siswa->foto ?? '-'
        ];
    }
}
