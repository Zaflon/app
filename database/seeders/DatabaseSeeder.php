<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** @var string */
    public const URL = '@URL@';

    /** @var string */
    public const COLUMNS = '@COLUMNS@';

    /** @var array */
    public const FIELDS = [
        \BrandsSeeder::class => [
            self::URL => "Brands.JSON",
            self::COLUMNS => [
                'name'
            ]
        ],
        \ColorsSeeder::class => [
            self::URL => "Colors.JSON",
            self::COLUMNS => [
                'cor',
                'color',
                'couleur',
                'farbe',
                'colore',
                'tonalidad',
                'kleur'
            ],
        ],
        \MeasurementUnitsSeeder::class =>  [
            self::URL => "MeasurementUnits.JSON",
            self::COLUMNS => [
                'measurement_unit',
                'abbreviation'
            ],
        ],
        \StatesSeeder::class => [
            self::URL => "Brazilian States's.JSON",
            self::COLUMNS => [
                'name',
                'abbreviation',
                'cUF'
            ]
        ]
    ];

    /** @var const */
    private const DATA = [
        \Database\Seeders\CouponsSeeder::class,
        \Database\Seeders\MeasurementUnitsSeeder::class,
        \Database\Seeders\BrandsSeeder::class,
        \Database\Seeders\StatesSeeder::class,
        \Database\Seeders\UserSeeder::class,
        \Database\Seeders\ColorsSeeder::class,
        \Database\Seeders\ProductsSeeder::class,
        \Database\Seeders\CategoriesSeeder::class,
        \Database\Seeders\ProductsCategoriesSeeder::class
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
