<?php

namespace Samshal\Rando\Basics\Tests;

class CharacterTest extends \PHPUnit_Framework_TestCase
{

    public function testCharacterStaticMethodWithNoParameters()
    {
        $expected = \Samshal\Rando\Rando::character();

        $this->assertInternalType('string', $expected);
    }

    /**
     * @depends testCharacterStaticMethodWithNoParameters
     */
    public function testCharacterStaticExpectFromPool()
    {
        $expected = \Samshal\Rando\Rando::character(['pool'=>'aWeS0m3#']);

        $this->assertRegExp('/(a)?(W)?(e)?(S)?(0)?(m)?(3)?(#)?/', $expected);
    }

    /**
     * @covers \Samshal\Rando\Rando::character
     */
    public function testCharacterStaticExpectUppercaseChar()
    {
        $expected = \Samshal\Rando\Rando::character(['casing'=>'upper']);

        $this->assertRegExp('/[A-Z]/', $expected);
    }


    /**
     * @covers \Samshal\Rando\Rando::character
     */
    public function testCharacterStaticExpectLowercaseChar()
    {
        $expected = \Samshal\Rando\Rando::character(['casing'=>'lower']);

        $this->assertRegExp('/[a-z]/', $expected);
    }

    /**
     * @covers \Samshal\Rando\Rando::character
     */
    public function testCharacterStaticExpectAlphanumericChar()
    {
        $expected = \Samshal\Rando\Rando::character(['alpha'=>true]);

        $this->assertRegExp('/[A-Za-z]/', $expected);
    }

    /**
     * @covers \Samshal\Rando\Rando::character 
     */
    public function testCharacterStaticExpectSymbol()
    {
        $expected = \Samshal\Rando\Rando::character(['symbols'=>true]);

        $this->assertRegExp('/(!)?(@)?(#)?(\$)?(%)?(\^)?(&)?(\()?(\))?/', $expected);
    }
}
