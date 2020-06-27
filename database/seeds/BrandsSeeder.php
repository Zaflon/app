<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BrandsSeeder extends Seeder
{
    /** @var string */
    public const URL = "https://raw.githubusercontent.com/MagicalStrangeQuark/JSON/master/Brands.JSON";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (json_decode(file_get_contents(self::URL)) as $brand) {
            DB::table('brands')->insert([
                'name' => $brand->name,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
