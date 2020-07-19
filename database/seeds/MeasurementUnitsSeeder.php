<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MeasurementUnitsSeeder extends Seeder
{
    /** @var string */
    public const URL = "MeasurementUnits.JSON";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Helpers\Utils::getSeederJSON(self::URL) as $MeasurementUnit) {
            DB::table('measurement_units')->insert([
                'measurement_unit' => $MeasurementUnit->measurement_unit,
                'abbreviation' => $MeasurementUnit->abbreviation,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
