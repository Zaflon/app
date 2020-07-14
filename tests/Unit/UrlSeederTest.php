<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UrlSeederTest extends TestCase
{
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
    public function testValidUrl()
    {
        foreach ($this->list() as $url) {
            if (is_array(json_decode(file_get_contents($url))) === false) {
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
    private function list(): array
    {
        return [
            \BrandsSeeder::URL
        ];
    }
}
