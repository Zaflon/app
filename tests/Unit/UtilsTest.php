<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * Underscore Test.
     * 
     * @return void
     */
    public function testUnderscore()
    {
        $this->assertEquals(\App\Helpers\Utils::underscore('bar'), 'bar');
        $this->assertEquals(\App\Helpers\Utils::underscore('Color'), 'color');
        $this->assertEquals(\App\Helpers\Utils::underscore('PaymentMethod'), 'payment_method');
        $this->assertEquals(\App\Helpers\Utils::underscore('FooBarGoo'), 'foo_bar_goo');
    }

    /**
     * Test Array IS subarray
     * 
     * @param void
     * 
     * @return void
     */
    public function testArrayContainsTrue()
    {
        $sub_array = ['morango', 'laranja'];

        $array = ['pêra', 'cereja', 'acabate', 'uva', 'laranja', 'acerola', 'morango'];

        $this->assertTrue(\App\Helpers\Utils::ArrayContains($sub_array, $array));
    }

    /**
     * Test Array IS NOT subarray
     * 
     * @param void
     * 
     * @return array
     */
    public function testArrayContainsFalse()
    {
        $sub_array = ['morango', 'laranja', 'golfinho'];

        $array = ['pêra', 'cereja', 'acabate', 'uva', 'laranja', 'acerola', 'morango'];

        $this->assertFalse(\App\Helpers\Utils::ArrayContains($sub_array, $array));
    }
}
