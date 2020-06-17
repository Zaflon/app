<?php

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
        foreach (json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'States.JSON')) as $State) {
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
