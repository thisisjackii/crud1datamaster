<?php

namespace App\Exports;

use App\Models\Hutang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class HutangExport implements WithHeadings, FromQuery
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
        return Hutang::query()
            ->where('user_id', $this->user_id)
            ->select(["id", "rekening", "jumlah_hutang", "nama_pemberi_hutang", "catatan_hutang", "tanggal_hutang", "jam_hutang", "tanggal_jatuh_tempo", "jam_jatuh_tempo", "status", "user_id"]);
    }

    public function headings():array{
        return ["Nomor", "Rekening", "Jumlah Hutang", "Nama Pemberi Hutang", "Catatan Hutang", "Tanggal Hutang", "Jam Hutang", "Tanggal Jatuh Tempo", "Jam Jatuh Tempo", "Status", "ID User"];
    }
}