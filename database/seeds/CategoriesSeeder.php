<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesSeeder extends Seeder
{
    /** @var string */
    private const FILENAME = "Category.JSON";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data() as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => Carbon::now()->format($format = 'Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format($format = 'Y-m-d H:i:s')
            ]);
        }
    }

    /**
     * Get Data.
     * 
     * @param void
     * 
     * @return array $flatted
     */
    public function data(): array
    {
        $arr = json_decode(json_encode(json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . self::FILENAME))), true);

        $flatted = [];

        foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($arr), RecursiveIteratorIterator::SELF_FIRST) as $key => $value) {
            array_push($flatted, $key);
        }

        sort($flatted, SORT_STRING);

        return $flatted;
    }
}
