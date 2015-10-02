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
	
	public function getGroups() {
		$arr = array();
		foreach ($this->groups as $group) {
			$arr[] = $group->getId();
		}
		return $arr;
	}
	public function getData() {
		return array('id'=>  $this->entity->getId(),'nick' => $this->entity->getNick());
	}
}
