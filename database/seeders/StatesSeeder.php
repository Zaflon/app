<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Helpers\Utils::getSeederJSON(\Database\Seeders\DatabaseSeeder::FIELDS[\StatesSeeder::class][\Database\Seeders\DatabaseSeeder::URL]) as $STATE) {
            $seed = [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            foreach (\Database\Seeders\DatabaseSeeder::FIELDS[\StatesSeeder::class][\Database\Seeders\DatabaseSeeder::COLUMNS] as $KEY => $INFO) {
                $seed[$INFO] = $STATE->{$INFO};
            }

            DB::table('states')->insert($seed);
        }
    }
}
