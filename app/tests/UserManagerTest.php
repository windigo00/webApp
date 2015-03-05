<?php
namespace Test;

use Nette;

class UserManagerTest extends \PHPUnit_Framework_TestCase
{
	private $container;
	/**
	 *
	 * @var \App\Model\User
	 */
	private $user;

	public function __construct()
	{
		$this->container = \App\Configs\AppConfig::getContainer();
	}
//
//	public function setUp()
//	{
//		$this->user = new \App\Model\User();
//	}
//	protected function tearDown() {
//		$this->user = NULL;
//	}
	public function testAddUser()
	{
//		$this->assertTrue(FALSE);
		$id = \App\Model\UserManager::add('aaaaaaaa', 'aaaaaaa');
		$user = \App\Model\User::get($id);
		$this->assertEquals(get_class($user), 'App\Model\User');
	}
}
