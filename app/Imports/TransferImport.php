<?php

namespace App\Imports;

use App\Models\TransferSaldo;
// use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransferImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return TransferSaldo|null
     */
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function model(array $row)
    {
        return new TransferSaldo([
            // 'id' => $row['id'],
            'sumber_rekening' => $row['sumber_rekening'],
            'tujuan_transfer' => $row['tujuan_transfer'],
            'jumlah_transfer' => $row['jumlah_transfer'],
            'tanggal' => $row['tanggal'],
            'jam' => $row['jam'],
            'biaya_admin' => $row['biaya_admin'],
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