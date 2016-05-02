<?php

Namespace Samshal\Rando\Basics\Tests;

class BoolTest extends \PHPUnit_Framework_TestCase {

	public function boolStaticMethodWithNoParametersTest(){
		$expected = \Samshal\Rando\Rando::bool();

		$this->assertInternalType('boolean', $expected);
	}

	/**
	 * @expectedException	ArrayParametersExpectedException
	 */
	public function boolStaticMethodWithInvalidParameterTest(){
		$expected = \Samshal\Rando\Rando::bool('likelihood=>90');
	}

	/**
	 * @expectedException	OptionNotSupportedException
	 */
	public function boolStaticMethodWithInexistentOptionTest(){
		$expected = \Samshal\Rando\Rando::bool(['accuracy'=>90]);
	}
}