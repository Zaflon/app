<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase
{
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
     * Test if Array IS subarray
     * 
     * @param void
     * 
     * @return void
     */
    public function testArrayContainsTrue()
    {
        $this->assertTrue(\App\Helpers\Utils::ArrayContains(
            ['strawberry', 'orange'],
            ['wait', 'cherry', 'avocado', 'grape', 'orange', 'passion fruit', 'strawberry']
        ));

        $this->assertTrue(\App\Helpers\Utils::ArrayContains(
            ['ã', 'â', 'ä', '\\'],
            ['ã', 'â', 'ä', '\\']
        ));
    }

    /**
     * Test if Array IS NOT subarray
     * 
     * @param void
     * 
     * @return array
     */
    public function testArrayContainsFalse()
    {
        $this->assertFalse(\App\Helpers\Utils::ArrayContains(
            ['strawberry', 'orange', 'monkey'],
            ['wait', 'cherry', 'avocado', 'grape', 'orange', 'passion fruit', 'strawberry']
        ));
    }
}
