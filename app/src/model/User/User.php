<?php
namespace App\Model;

/**
 * User model
 **/
class User extends  \App\Model\Model
{
	protected static $entityClass = '\App\Model\Entities\Users';
	public function getName() {
		return $this->firstname.' '.$this->lastname;
	}
}
