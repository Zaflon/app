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
        foreach (json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Colors.JSON')) as $key => $color) {
            DB::table('colors')->insert([
                'cor' => $color->cor,
                'color' => $color->color,
                'couleur' => $color->couleur,
                'farbe' => $color->farbe,
                'colore' => $color->colore,
                'tonalidad' => $color->tonalidad,
                'kleur' => $color->kleur,
                'hexadecimal' => $key,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
