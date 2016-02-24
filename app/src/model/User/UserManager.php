<?php

namespace App\Model\Security;

use Nette,
	Nette\Security\IAuthenticator,
	Nette\Security\IAuthorizator,
	Nette\Security\Identity,
	Nette\Security\Passwords,
	Nette\Security\AuthenticationException,
	App\Management\EntityManager,
	App\Model\User
		;

/**
 * Users management.
 */
class UserManager extends \Nette\Object implements IAuthenticator, IAuthorizator
{
	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		$user = User::rep()->findOneByNick($username);
		
		if (!$user) {
			throw new AuthenticationException('The username is incorrect.', static::IDENTITY_NOT_FOUND);
		} elseif (!Passwords::verify($password, $user->pwd)) {
			throw new AuthenticationException('The password is incorrect.', static::INVALID_CREDENTIAL);
		} elseif (Passwords::needsRehash($user->pwd)) {
			$user->setPassword(Passwords::hash($password));
			$user->persist();
		}
		$groups = array();
		foreach ($user->groups as $group) $groups[] = $group->id;
		return new Identity($user->id, $groups);
	}


	/**
	 * Adds new user.
	 * @param  string
	 * @param  string
	 * @return integer New id
	 */
	public static function add($username, $password)
	{
		$user = new User();
		$user->nick = $username;
		$user->pwd = $password;
		$user->active = TRUE;
		$user->persist();
		return $user->id;
	}
	
	public static function getList() {
		return EntityManager::get()->findAll();
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
			case 'editItem':
				$privilege = 'edit';
				break;
			case 'add':
			case 'addItem':
				$privilege = 'create';
				break;
		}
		$res = AclRecord::findOneBy(array(
			'resource'  => $resource,
			'privilege' => $privilege,
			'userGroup'     => 'IN('.!is_object($role) ? $role : $role->getId().')',
			'allowed'   => TRUE));
		if ($res === NULL) {
			return FALSE;
		}
		return TRUE;
	}
}
