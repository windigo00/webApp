<?php

namespace App\Model;

use Nette,
	Nette\Security\Passwords;

/**
 * Users management.
 */
class UserManager extends Nette\Object implements Nette\Security\IAuthenticator, \Nette\Security\IAuthorizator
{
	private static $_inst;
	protected $database;
	protected $users = array();
	protected $active = array();
	
	public function __construct(Nette\Database\Context $database)
	{
		$this->database = \App\Model\User::getRepository($database)->repo;
		self::$_inst = $this;
	}

	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		
		$row = $this->database->findOneByNick($username);
		if (!$row) {
			throw new Nette\Security\AuthenticationException('The username is incorrect.', static::IDENTITY_NOT_FOUND);
		} elseif (!Passwords::verify($password, $row->getPassword())) {
			throw new Nette\Security\AuthenticationException('The password is incorrect.', static::INVALID_CREDENTIAL);
		} elseif (Passwords::needsRehash($row->getPassword())) {
			$row->setPassword(Passwords::hash($password));
			$row->persist();
		}
		$id = new Nette\Security\Identity($row->getId(), $row->getRole(), $row);
		
		return $id;
	}


	/**
	 * Adds new user.
	 * @param  string
	 * @param  string
	 * @return void
	 */
	public function add($username, $password)
	{
		$this->database->table(static::TABLE_NAME)->insert(array(
			static::COLUMN_NAME => $username,
			static::COLUMN_PASSWORD_HASH => Passwords::hash($password),
		));
	}
	
	public static function getList() {
		return self::$_inst->database->findAll();
	}


	/**
	 * Performs a role-based authorization.
	 * @param  string  role
	 * @param  string  resource
	 * @param  string  privilege
	 * @return bool
	 */
	public function isAllowed($role, $resource, $privilege) {
//		dump();
		return TRUE;
	}
}
