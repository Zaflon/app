<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UnderscoreTest extends TestCase
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
}
