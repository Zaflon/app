<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Helpers\Utils::getSeederJSON(\DatabaseSeeder::FIELDS[\ColorsSeeder::class][\DatabaseSeeder::URL]) as $key => $COLOR) {
            $stub = [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'hexadecimal' => $key
            ];

            foreach (\DatabaseSeeder::FIELDS[\ColorsSeeder::class][\DatabaseSeeder::COLUMNS] as $INFO) {
                $stub[$INFO] = $COLOR->{$INFO};
            }

            DB::table('colors')->insert($stub);
        }
    }
}
