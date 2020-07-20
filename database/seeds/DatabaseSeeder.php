<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** @var const */
    private const DATA = [
        \UserSeeder::class,
        \StatesSeeder::class,
        \MeasurementUnitsSeeder::class,
        \ColorsSeeder::class,
        \BrandsSeeder::class,
        \ProductsSeeder::class
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (self::data() as $data) {
            $this->call($data);
        }
    }

    /**
     * Get Data.
     * 
     * @param void
     * 
     * @return array
     */
    public static function data(): array
    {
        return self::DATA;
    }
}
