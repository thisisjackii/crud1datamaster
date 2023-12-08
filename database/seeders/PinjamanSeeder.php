<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PinjamanSeeder extends Seeder
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
            DB::table('pinjaman')->insert([
                'rekening' => rand(100000000, 999999999) . '', // Concatenate with an empty string
                'jumlah_pinjaman' => rand(100, 999) * 1000,
                'nama_diberi_pinjaman' => 'Lender ' . ($i + 1),
                'catatan_pinjaman' => 'Loan Note ' . ($i + 1),
                'tanggal_pinjaman' => now()->toDateString(),
                'jam_pinjaman' => now()->toTimeString(),
                'tanggal_jatuh_tempo' => now()->addDays(rand(7, 30))->toDateString(),
                'jam_jatuh_tempo' => now()->addHours(rand(1,12))->toDateString(), // You can modify this as needed
                'status' => ($i % 2 == 0) ? 'Sudah Lunas' : 'Belum Lunas',
                'user_id' => ($i % 2 == 0) ? 2 : 1, // Replace with the actual user_id
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
