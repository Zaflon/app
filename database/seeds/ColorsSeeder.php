<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ColorsSeeder extends Seeder
{
    /** @var string */
    public const URL = "Colors.JSON";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Helpers\Utils::getSeederJSON(self::URL) as $key => $color) {
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
