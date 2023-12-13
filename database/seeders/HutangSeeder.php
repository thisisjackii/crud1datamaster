<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Hutang;
use App\Http\Controllers\RiwayatController;

class HutangSeeder extends Seeder
{
    private $riwayatController;

    public function __construct(RiwayatController $riwayatController)
    {
        $this->riwayatController = $riwayatController;
    }

    public function run()
    {
        $numberOfRecords = 2000;

        for ($i = 0; $i < $numberOfRecords; $i++) {
            $hutang = DB::table('hutang')->insertGetId([
                'rekening' => 'Rekening ' . ($i + 1),
                'jumlah_hutang' => rand(100, 999) * 1000,
                'nama_pemberi_hutang' => 'Pemberi Hutang ' . ($i + 1),
                'catatan_hutang' => 'Catatan Hutang ' . ($i + 1),
                'tanggal_hutang' => now()->toDateString(),
                'jam_hutang' => now()->toTimeString(),
                'tanggal_jatuh_tempo' => now()->addDays(30)->toDateString(),
                'jam_jatuh_tempo' => now()->addDays(30)->toTimeString(),
                'status' => ($i % 2 == 0) ? 'Sudah Lunas' : 'Belum Lunas',
                'user_id' => ($i % 2 == 0) ? 2 : 1, // Replace with the actual user_id
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create Riwayat entry
            $this->riwayatController->tambahRiwayat('HTG', $hutang, now()->toDateString(), now()->toTimeString(), ($i % 2 == 0) ? 2 : 1);
        }
    }
}
