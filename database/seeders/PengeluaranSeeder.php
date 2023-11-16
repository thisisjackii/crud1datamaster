<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // You can adjust the number of records you want to seed
        $numberOfRecords = 10;

        for ($i = 0; $i < $numberOfRecords; $i++) {
            DB::table('pengeluaran')->insert([
                'nama_kategori' => 'Category ' . ($i + 1),
                'nama_pengeluaran' => 'Expense ' . ($i + 1),
                'tujuan_transaksi' => 'Transaction Purpose ' . ($i + 1),
                'kuantitas' => rand(1, 10),
                'harga_peritem' => rand(10, 100),
                'tanggal' => now()->toDateString(),
                'jam' => now()->toTimeString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
