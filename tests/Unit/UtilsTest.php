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

    /**
     * Test Array to Object Recursively.
     * 
     * @param void
     */
    public function testArr2obj()
    {
        $arr = (array) [0 => [1 => [2 => [3 => [4 => [5 => [6 => DIRECTORY_SEPARATOR]]]]]]];

        $arr2obj = \App\Helpers\Utils::arr2obj($arr);

        $stub = new \StdClass();
        $stub->{0} = new \stdClass();
        $stub->{0}->{1} = new \stdClass();
        $stub->{0}->{1}->{2} = new \StdClass();
        $stub->{0}->{1}->{2}->{3} = new \StdClass();
        $stub->{0}->{1}->{2}->{3}->{4} = new \StdClass();
        $stub->{0}->{1}->{2}->{3}->{4}->{5} = new \StdClass();
        $stub->{0}->{1}->{2}->{3}->{4}->{5}->{6} = DIRECTORY_SEPARATOR;

        $this->assertTrue($stub == $arr2obj);

        $this->assertTrue($stub->{0}->{1}->{2}->{3}->{4}->{5}->{6} === $arr2obj->{0}->{1}->{2}->{3}->{4}->{5}->{6});
    }
}
