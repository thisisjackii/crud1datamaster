<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PengeluaranExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pengeluaran::all();
    }

    public function headings():array{
        return ["ID", "Nama Kategori", "Nama Pengeluaran", "Tujuan Transaksi", "Kuantitas", "Harga Per Item", "Tanggal", "Jam"];
    }
}