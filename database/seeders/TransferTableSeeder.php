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
        // You can adjust the number of records you want to seed
        $numberOfRecords = 2000;
        $paymentMethods = ['GOPAY', 'SHOPEE PAY', 'OVO'];

        for ($i = 0; $i < $numberOfRecords; $i++) {
            DB::table('transfer_saldo')->insert([
                'sumber_rekening' => $paymentMethods[array_rand($paymentMethods)],
                'tujuan_transfer' => $paymentMethods[array_rand($paymentMethods)],
                'jumlah_transfer' => rand(100, 999) * 1000,
                'tanggal' => now()->toDateString(),
                'jam' => now()->toTimeString(),
                'biaya_admin' => rand(100, 999) * 10,
                'user_id' => ($i % 2 == 0) ? 2 : 1, // Replace with the actual user_id
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
