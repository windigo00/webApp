<?php

namespace App\Model;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-31 at 02:31:36.
 */
class SystemEventTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var SystemEvent
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = SystemEvent::get(1);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

	/**
	 * @covers App\Model\SystemEvent::findAll
	 */
	public function testFindAll() {
		$this->assertEquals(0, count(SystemEvent::findAll()));
	}
}