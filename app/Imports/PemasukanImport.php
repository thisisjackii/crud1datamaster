<?php

namespace App\Imports;

use App\Models\Pemasukan;
// use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PemasukanImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Pemasukan|null
     */
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function model(array $row)
    {
        return new Pemasukan([
            // 'id' => $row['id'],
            'nama_kategori' => $row['nama_kategori'],
            'rekening' => $row['rekening'],
            'jumlah_pemasukan' => $row['jumlah_pemasukan'],
            'catatan_pemasukan' => $row['catatan_pemasukan'],
            'tanggal' => $row['tanggal'],
            'jam' => $row['jam'],
            'user_id' => $this->userId,
        ]);
    }

    
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ","
        ];
    }
}