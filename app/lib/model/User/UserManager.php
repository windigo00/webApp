<?php

namespace App\Model;

use Nette,
	Nette\Security\IAuthenticator,
	Nette\Security\IAuthorizator,
	Nette\Security\Identity,
	Nette\Security\Passwords,
	Nette\Security\AuthenticationException,
	App\Model\User
		;

/**
 * Users management.
 */
class UserManager extends \Nette\Object implements IAuthenticator, IAuthorizator
{
	private static $_inst;
	protected $database;
	protected $users = array();
	protected $active = array();
	
	public function __construct(Nette\Database\Context $database)
	{
		
		$this->database = User::getRepository($database);
		
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
//		dump($this->database);exit;
		$row = $this->database->findOneByNick($username);
		if (!$row) {
			throw new AuthenticationException('The username is incorrect.', static::IDENTITY_NOT_FOUND);
		} elseif (!Passwords::verify($password, $row->getPassword())) {
			throw new AuthenticationException('The password is incorrect.', static::INVALID_CREDENTIAL);
		} elseif (Passwords::needsRehash($row->getPassword())) {
			$row->setPassword(Passwords::hash($password));
			$row->persist();
		}
		$id = new Identity($row->getId(), $row->getRoles()->toArray(), $row);
		
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
		/// Presenter actions conversion
		switch ($privilege) {
			case 'default':
				$privilege = 'view';
				break;
			case 'add':
				$privilege = 'create';
				break;
		}
		
		$res = Security\AclRecord::getRepository()->findOneBy(array(
			'resource'  => $resource,
			'privilege' => $privilege,
			'group'     => is_string($role) ? $role : $role->getId(),
			'allowed'   => TRUE));
		if ($res === NULL) {
			
			return FALSE;
		}
		return TRUE;
	}
}
