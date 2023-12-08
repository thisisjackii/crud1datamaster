<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $imagePath = 'public/user_images';
        Storage::makeDirectory($imagePath);

        for ($i = 0; $i < 1; $i++) {
            $filename = "user1-128x128.jpg";
            Storage::copy("public/user_images_template/{$filename}", "{$imagePath}/{$filename}");

            \App\Models\User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'user_image' => $filename,
            ]);
        }
    }
}
