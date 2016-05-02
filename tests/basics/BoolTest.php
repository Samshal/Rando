<?php

Namespace Samshal\Rando\Basics\Tests;

class BoolTest extends \PHPUnit_Framework_TestCase {

	public function boolStaticMethodWithNoParametersTest(){
		$expected = \Samshal\Rando\Rando::bool();

		$this->assertInternalType('boolean', $expected);
	}

	/**
	 * @depends boolStaticMethodWithNoParametersTest
	 */
	public function boolStaticExpectTrueTest(){
		$expected = \Samshal\Rando\Rando::bool(['likelihood'=>100]);

		$this->assertEquals(true, $expected);
	}

	/**
	 * @depends boolStaticMethodWithNoParametersTest
	 */
	public function boolStaticExpectFalseTest(){
		$expected = \Samshal\Rando\Rando::bool(['likelihood'=>0]);

		$this->assertEquals(false, $expected);
	}

	/**
	 * @covers \Samshal\Rando\Rando::bool
	 * @expectedException ArrayParametersExpectedException
	 */
	public function boolStaticMethodWithInvalidParameterTest(){
		$expected = \Samshal\Rando\Rando::bool('likelihood=>90');

		$this->assertInternalType('boolean', $expected);		
	}

	/**
	 * @covers \Samshal\Rando\Rando::bool 	
	 * @expectedException OptionNotSupportedException
	 */
	public function boolStaticMethodWithInexistentOptionTest(){
		$expected = \Samshal\Rando\Rando::bool(['accuracy'=>90]);

		$this->assertInternalType('boolean', $expected);
	}
}