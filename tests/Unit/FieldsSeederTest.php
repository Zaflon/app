<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class FieldsSeederTest extends TestCase
{
    /** @var string */
    private const URL = 'URL';

    /** @var string */
    private const COLUMNS = 'COLUMNS';

    /** @var array */
    private const FIELDS = [
        \App\Brand::class => [
            self::URL => \BrandsSeeder::URL,
            self::COLUMNS => [
                'name'
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
    public function testFields()
    {
        foreach ($this->fields() as $field) {
            $dado = \App\Helpers\Utils::arr2obj(json_decode(file_get_contents($field->{self::URL})));

            $this->assertTrue(\App\Helpers\Utils::ArrayContains((array) $field->{self::COLUMNS}, (array) array_keys(get_object_vars($dado->{0}))));
        }
    }

    /**
     * Fields Getter.
     * 
     * @param void
     * 
     * @return stdClass
     */
    public function fields(): \stdClass
    {
        return json_decode(json_encode(self::FIELDS, JSON_FORCE_OBJECT));
    }
}
