<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatesSeeder extends Seeder
{
    /** @var string */
    public const URL = "Brazilian States's.JSON";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Helpers\Utils::getSeederJSON(self::URL) as $State) {
            DB::table('states')->insert([
                'name' => $State->Name,
                'abbreviation' => $State->Abbreviation,
                'cUF' => $State->cUF,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
