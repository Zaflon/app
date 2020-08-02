<?php

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
        \MeasurementUnitsSeeder::class,
        \BrandsSeeder::class,
        \StatesSeeder::class,
        \UserSeeder::class,
        \ColorsSeeder::class,
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
