<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RiwayatController;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $riwayatController;

    public function __construct(RiwayatController $riwayatController)
    {
        $this->riwayatController = $riwayatController;
    }

    public function run()
    {
        // You can adjust the number of records you want to seed
        $numberOfRecords = 2000;

        for ($i = 0; $i < $numberOfRecords; $i++) {
            $pengeluaran = DB::table('pengeluaran')->insert([
                'nama_kategori' => 'Category ' . ($i + 1),
                'nama_pengeluaran' => 'Expense ' . ($i + 1),
                'tujuan_transaksi' => 'Transaction Purpose ' . ($i + 1),
                'kuantitas' => rand(1, 10),
                'harga_peritem' => rand(100, 999) * 1000,
                'tanggal' => now()->toDateString(),
                'jam' => now()->toTimeString(),
                'user_id' => ($i % 2 == 0) ? 2 : 1, // Replace with the actual user_id
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->riwayatController->tambahRiwayat('PNG', $pengeluaran, now()->toDateString(), now()->toTimeString(), ($i % 2 == 0) ? 2 : 1);
        }
    }
}
