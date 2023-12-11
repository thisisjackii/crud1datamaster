<?php

namespace App\Exports;

use App\Models\Pemasukan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class PemasukanExport implements WithHeadings, FromQuery
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
        return Pemasukan::query()
            ->where('user_id', $this->user_id)
            ->select(["id", "nama_kategori", "rekening", "jumlah_pemasukan", "catatan_pemasukan", "tanggal", "jam", "user_id"]);
    }

    public function headings():array{
        return ["Nomor", "Nama Pemasukan", "Pilih Rekening", "Jumlah Pemasukan", "Catatan Pemasukan", "Tanggal", "Jam", "ID User"];
    }
}