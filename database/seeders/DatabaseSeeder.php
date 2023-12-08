<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        for ($i = 0; $i < 2; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }

        $this->call([
            HutangSeeder::class,
            PemasukanSeeder::class,
            PengeluaranSeeder::class,
            TransferTableSeeder::class,
            PinjamanSeeder::class,
            // Add other seeders here
        ]);
    }
}
