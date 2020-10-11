<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CouponsSeeder extends Seeder
{
    /** @var string */
    private const FILENAME = "Coupon.JSON";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . self::FILENAME));

        foreach ($data as $COUPON) {
            $seed = [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $seed["name"] = $COUPON->coupon;
            $seed["detail"] = $COUPON->detail;
            $seed["price"] = 0.00;

            DB::table('coupons')->insert($seed);
        }
    }
}
