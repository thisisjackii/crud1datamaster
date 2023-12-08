<?php

namespace App\Imports;

use App\Models\Pinjaman;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class PinjamanImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return Pinjaman|null
    */
    public function model(array $row)
    {
        return new Pinjaman([
            'rekening' => $row['rekening'],
            'jumlah_pinjaman' => $row['jumlah_pinjaman'],
            'nama_diberi_pinjaman' => $row['nama_diberi_pinjaman'],
            'catatan_pinjaman' => $row['catatan_pinjaman'],
            'tanggal_pinjaman' => $row['tanggal_pinjaman'],
            'jam_pinjaman' => $row['jam_pinjaman'],
            'tanggal_jatuh_tempo' => $row['tanggal_jatuh_tempo'],
            'jam_jatuh_tempo' => $row['jam_jatuh_tempo'],
            'status' => $row['status'],
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ","
        ];
    }
}
