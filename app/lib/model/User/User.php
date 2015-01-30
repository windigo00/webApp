<?php
namespace App\Model\User;

use Nette,
	App\Model\DBObject,
	Nette\Security\Passwords
	;

/**
 * Description of User
 *
 * @author KuBik
 */
class User extends DBObject {
	const
		TABLE_NAME = 'user',
		COLUMN_NAME = 'nick',
		COLUMN_PASSWORD_HASH = 'pwd',
		COLUMN_ROLE = 'role';
	
	public function getName() {
		return $this->get(static::COLUMN_NAME);
	}
	public function getPassword() {
		return $this->get(static::COLUMN_PASSWORD_HASH);
	}
	public function getRole() {
		return $this->get(static::COLUMN_ROLE);
	}
	
	public function setName($name) {
		$this->set(static::COLUMN_NAME, $nme);
	}
	public function setPassword($pass) {
		$this->set(static::COLUMN_PASSWORD_HASH, Passwords::hash($pass));
	}
	public function setRole($role) {
		$this->set(static::COLUMN_ROLE, $role);
	}
}
