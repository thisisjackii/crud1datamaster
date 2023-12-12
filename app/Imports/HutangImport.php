<?php

namespace App\Imports;

use App\Models\Hutang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class HutangImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return Hutang|null
    */

    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function model(array $row)
    {
        return new Hutang([
            'rekening' => $row['rekening'],
            'jumlah_hutang' => $row['jumlah_hutang'],
            'nama_pemberi_hutang' => $row['nama_pemberi_hutang'],
            'catatan_hutang' => $row['catatan_hutang'],
            'tanggal_hutang' => $row['tanggal_hutang'],
            'jam_hutang' => $row['jam_hutang'],
            'tanggal_jatuh_tempo' => $row['tanggal_jatuh_tempo'],
            'jam_jatuh_tempo' => $row['jam_jatuh_tempo'],
            'status' => $row['status'],
            'user_id' => $this->userId, // Set the user_id from the constructor
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ","
        ];
    }
}
