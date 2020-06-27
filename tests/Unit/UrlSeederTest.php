<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlSeederTest extends TestCase
{
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
