<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UrlSeederTest extends TestCase
{
    /** @var string */
    private const URL = '@URL@';

    /** @var string */
    private const COLUMNS = '@COLUMNS@';

    /** @var array */
    private const FIELDS = [
        [
            self::URL => \BrandsSeeder::URL,
            self::COLUMNS => [
                'name'
            ]
        ],
        [
            self::URL => \ColorsSeeder::URL,
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
        [
            self::URL => \MeasurementUnitsSeeder::URL,
            self::COLUMNS => [
                'measurement_unit',
                'abbreviation'
            ],
        ],
        [
            self::URL => \StatesSeeder::URL,
            self::COLUMNS => [
                'name',
                'abbreviation',
                'cUF'
            ]
        ]
    ];

    /**
     * These fields must to be present in each JSON files.
     * 
     * @param void
     * 
     * @return void
     */
    public function testFields(): void
    {
        $data = \App\Helpers\Utils::arr2obj(self::FIELDS);

        foreach ($data as $url) {
            $content = \App\Helpers\Utils::getSeederJSON($url->{self::URL});

            $first = $content->{array_key_first((array)$content)};

            $this->assertTrue(\App\Helpers\Utils::ArrayContains(
                (array) $url->{self::COLUMNS},
                (array) array_keys(get_object_vars($first))
            ));
        }
    }

    /**
     * @test
     * 
     * Check if all classes exists.
     * 
     * @param void
     */
    public function assertPreConditions(): void
    {
        foreach (\DatabaseSeeder::data() as $data) {
            if ((bool)(class_exists($data)) === false) {
                $this->assertTrue(false);
            }
        }

        $this->assertTrue(true);
    }

    /**
     * URL Test.
     *
     * @return void
     */
    public function testValidUrl(): void
    {
        foreach ($this->URL() as $URL) {
            if ((bool)(\App\Helpers\Utils::getSeederJSON($URL) instanceof \stdClass) === false) {
                $this->assertTrue(false);
            }
        }

        $this->assertTrue(true);
    }

    /**
     * URL Getter.
     * 
     * @param void
     */
    public function URL(): array
    {
        $Address = [];

        foreach (self::FIELDS as $KEY => $URL) {
            $Address[] = $URL[self::URL];
        }

        return $Address;
    }
}
