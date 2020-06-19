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
        foreach (json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'MeasurementUnits.JSON')) as $MeasurementUnit) {
            DB::table('measurement_units')->insert([
                'measurement_unit' => $MeasurementUnit->measurement_unit,
                'abbreviation' => $MeasurementUnit->abbreviation,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
