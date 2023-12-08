<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemasukanSeeder extends Seeder
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
            DB::table('pemasukan')->insert([
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
        }
    }
}
