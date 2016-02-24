<?php

namespace App\Model;
use App\Management\EntityManager,
	App\Model\Menu;
/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-30 at 20:52:49.
 */
class MenuTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var Menu
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = Menu::get(1);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}
	
	/**
	 * @covers App\Model\Menu::id
	 */
	public function testGetId() {
		$this->assertTrue($this->object->id === 1);
	}
	/**
	 * @covers App\Model\Menu::findAll
	 */
	public function testFindAll() {
		$this->assertEquals(10, count(Menu::findAll()));
	}
	/**
	 * @covers App\Model\Menu::items
	 */
	public function testGetMenuItems() {
		$items = $this->object->items;
		$this->assertNotNull($items);
		$this->assertTrue($items->count() === 8, 'has to be 8, was '.$items->count());
	}
	/**
	 * @covers App\Model\Menu::getRootMenuItems
	 */
	public function testGetRootMenuItems() {
		$items = $this->object->getRootMenuItems();
		$this->assertNotNull($items);
		$this->assertTrue($items->count() === 2, 'has to be 2, was '.$items->count());
	}

}
