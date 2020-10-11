<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Product::all()->pluck((new \App\Models\Product())->getKeyName())->toArray() as $PK) {
            DB::table('products_categories')->insert([
                'product_id' => $PK,
                'category_id' => rand(1, \App\Models\Category::all()->count()),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
