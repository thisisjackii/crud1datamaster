<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class PengeluaranExport implements WithHeadings, FromQuery
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
        return Pengeluaran::query()
            ->where('user_id', $this->user_id)
            ->select(["id", "nama_kategori", "nama_pengeluaran", "tujuan_transaksi", "kuantitas", "harga_peritem", "tanggal", "jam", "user_id"]);
    }

    public function headings():array{
        return ["ID", "Nama Kategori", "Nama Pengeluaran", "Tujuan Transaksi", "Kuantitas", "Harga Per Item", "Tanggal", "Jam", "ID User"];
    }
}