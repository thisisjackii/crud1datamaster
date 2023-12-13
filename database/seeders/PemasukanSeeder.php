<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\RiwayatController;

class PemasukanSeeder extends Seeder
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
            $pemasukan = DB::table('pemasukan')->insertGetId([
                'nama_kategori' => 'Salary' . ($i + 1),
                'rekening' => 'Bank Account' . ($i + 1),
                'jumlah_pemasukan' => rand(100, 999) * 1000,
                'catatan_pemasukan' => 'Monthly Salary' . ($i + 1),
                'tanggal' => now()->toDateString(),
                'jam' => now()->toTimeString(),
                'user_id' => ($i % 2 == 0)? 2 : 1, // Replace with an existing user ID
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->riwayatController->tambahRiwayat('PMS', $pemasukan, now()->toDateString(), now()->toTimeString(), ($i % 2 == 0) ? 2 : 1);
        }
    }
}
