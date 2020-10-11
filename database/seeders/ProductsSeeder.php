<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 25; $i++) {
            DB::table('products')->insert([
                'name' => $faker->firstName,
                'weight' => rand($min = pow(2, 2), $max = pow(8, 8)),
                'info' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'image' => $faker->imageUrl($width = rand(0, 100), $height = rand(0, 100), $category = 'abstract', $randomize = true, $word = \Illuminate\Support\Str::random(rand(2, 8))),
                'detail' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'brand_id' => rand($min = 1, $max = \App\Models\Brand::count()),
                'created_at' => Carbon::now()->format($format = 'Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format($format = 'Y-m-d H:i:s')
            ]);
        }
    }
}
