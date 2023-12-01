<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'sumber_rekening' => '123456789',
                'tujuan_transfer' => '987654321',
                'jumlah_transfer' => 1000,
                'tanggal' => now(),
                'jam' => 12,
                'biaya_admin' => 5,
            ],
            // Add more data as needed
        ];

        // Insert data into the transfers table
        DB::table('transfer_saldo')->insert($data);
    }
}
