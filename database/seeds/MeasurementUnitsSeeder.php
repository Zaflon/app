<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MeasurementUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Helpers\Utils::getSeederJSON(\DatabaseSeeder::FIELDS[\MeasurementUnitsSeeder::class][\DatabaseSeeder::URL]) as $MEASUREMENT_UNIT) {
            $stub = [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            foreach (\DatabaseSeeder::FIELDS[\MeasurementUnitsSeeder::class][\DatabaseSeeder::COLUMNS] as $INFO) {
                $stub[$INFO] = $MEASUREMENT_UNIT->{$INFO};
            }

            DB::table('measurement_units')->insert($stub);
        }
    }
}
