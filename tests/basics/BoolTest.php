<?php

Namespace Samshal\Rando\Basics\Tests;

class BoolTest extends \PHPUnit_Framework_TestCase {

	public function testBoolStaticMethodWithNoParameters(){
		$expected = \Samshal\Rando\Rando::bool();

		$this->assertInternalType('boolean', $expected);
	}

	/**
	 * @depends boolStaticMethodWithNoParametersTest
	 */
	public function testBoolStaticExpectTrue(){
		$expected = \Samshal\Rando\Rando::bool(['likelihood'=>100]);

		$this->assertEquals(true, $expected);
	}

	/**
	 * @depends boolStaticMethodWithNoParametersTest
	 */
	public function testBoolStaticExpectFalse(){
		$expected = \Samshal\Rando\Rando::bool(['likelihood'=>0]);

		$this->assertEquals(false, $expected);
	}

	/**
	 * @covers \Samshal\Rando\Rando::bool
	 * @expectedException \Samshal\Rando\Exceptions\ArrayParametersExpectedException
	 */
	public function testBoolStaticMethodWithInvalidParameter(){
		$expected = \Samshal\Rando\Rando::bool('likelihood=>90');

		$this->assertInternalType('boolean', $expected);		
	}

	/**
	 * @covers \Samshal\Rando\Rando::bool 	
	 * @expectedException \Samshal\Rando\Exceptions\OptionNotSupportedException
	 */
	public function testBoolStaticMethodWithInexistentOption(){
		$expected = \Samshal\Rando\Rando::bool(['accuracy'=>90]);

		$this->assertInternalType('boolean', $expected);
	}
}