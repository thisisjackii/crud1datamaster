<?php

namespace App\Exports;

use App\Models\TransferSaldo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class TransferExport implements WithHeadings, FromQuery
{
    use Exportable;

    protected $user_id;

    public function forUserId(int $user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }
    public function query()
    {
        return TransferSaldo::query()
            ->where('user_id', $this->user_id)
            ->select(["id", "sumber_rekening", "tujuan_transfer", "jumlah_transfer", "tanggal", "jam", "biaya_admin", "user_id"]);
    }

    public function headings():array{
        return ["Nomor", "Sumber Rekening", "Tujuan Transfer", "Jumlah Transfer", "Tanggal", "Jam", "Biaya Admin", "ID User"];
    }
}