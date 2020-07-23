<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase
{
    /** @var string */
    private const STRICT_HEXADECIMAL_COLOR_REGEX = '/^#[\d\w+]{6}$/';

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
     * Test array to object recursively.
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

    /**
     * Test case where the argument is empty.
     * 
     * @param void
     */
    public function testArr2objWithEmptyArgument()
    {
        $this->assertTrue(\App\Helpers\Utils::arr2obj([]) instanceof \stdClass);
    }

    /**
     * Test for obtaining a random color in hexadecimal format.
     * 
     * @param void
     */
    public function testgetHEXRandomColor(): void
    {
        $this->assertTrue((bool)(preg_match(self::STRICT_HEXADECIMAL_COLOR_REGEX, \App\Helpers\Utils::getHEXRandomColor())));
    }

    /**
     * Test for obtaining an array of random colors in hexadecimal format.
     * 
     * @param void
     */
    public function testgetArrayOfHexColors()
    {
        $n = rand(2, 128);

        $data = \App\Helpers\Utils::getArrayOfHexColors($n);

        $this->assertCount($n, $data);

        foreach ($data as $data) {
            $this->assertTrue((bool)(preg_match(self::STRICT_HEXADECIMAL_COLOR_REGEX, $data)));
        }
    }

    /**
     * Test case where the method getArrayOfHexColors receive an negative value as argument.
     * 
     * @param void
     */
    public function testgetArrayOfHexColorsWithNegativeArgument()
    {
        $this->expectException(\Symfony\Component\Routing\Exception\InvalidParameterException::class);

        \App\Helpers\Utils::getArrayOfHexColors(-1);
    }

    /**
     * Test case where the method getArrayOfHexColors receive an null value as argument.
     * 
     * @param void
     */
    public function testgetArrayOfHexColorsWithZeroasArgument()
    {
        $this->expectException(\Symfony\Component\Routing\Exception\InvalidParameterException::class);

        \App\Helpers\Utils::getArrayOfHexColors(0);
    }

    /**
     * Test the conversion of the controller name, along with the respective namespace to a friendly format.
     * 
     * @param void
     */
    public function testCtrlr2string()
    {
        $this->assertEquals('Color', \App\Helpers\Utils::ctrlr2string('App\Http\Controllers\ColorController'));
        $this->assertEquals('PaymentMethod', \App\Helpers\Utils::ctrlr2string('App\Http\Controllers\PaymentMethodController'));
        $this->assertEquals('ProductStockLocation', \App\Helpers\Utils::ctrlr2string('App\Http\Controllers\ProductStockLocationController'));
    }
}
