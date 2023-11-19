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
        $imagePath = storage_path('app/public/user_images');
        if (!file_exists($imagePath)) {
            mkdir($imagePath, 0777, true);
        }

        foreach (range(1, 50) as $index) {
            $imageFileName = $faker->image($imagePath, 200, 200, 'people', false);

            \App\Models\User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'user_image' => 'user_images/' . $imageFileName,
            ]);
        }
    }
}
