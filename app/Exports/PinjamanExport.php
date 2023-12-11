<?php

namespace App\Exports;

use App\Models\Pinjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class PinjamanExport implements WithHeadings, FromQuery
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
        return Pinjaman::query()
            ->where('user_id', $this->user_id)
            ->select(["id", "rekening", "jumlah_pinjaman", "nama_diberi_pinjaman", "catatan_pinjaman", "tanggal_pinjaman", "jam_pinjaman", "tanggal_jatuh_tempo", "jam_jatuh_tempo", "status", "user_id"]);
    }

    public function headings():array{
        return ["Nomor", "Rekening", "Jumlah Pinjaman", "Nama Diberi Pinjaman", "Catatan Pinjaman", "Tanggal Pinjaman", "Jam Pinjaman", "Tanggal Jatuh Tempo", "Jam Jatuh Tempo", "Status", "ID User"];
    }
}