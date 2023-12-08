<?php

namespace App\Imports;

use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PengeluaranImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Pengeluaran|null
     */
    public function model(array $row)
    {
        return new Pengeluaran([
            // 'id' => $row['id'],
            'nama_kategori' => $row['nama_kategori'],
            'nama_pengeluaran' => $row['nama_pengeluaran'],
            'tujuan_transaksi' => $row['tujuan_transaksi'],
            'kuantitas' => $row['kuantitas'],
            'harga_peritem' => $row['harga_peritem'],
            'tanggal' => $row['tanggal'],
            'jam' => $row['jam'],

        ]);
    }

    
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ","
        ];
    }
}