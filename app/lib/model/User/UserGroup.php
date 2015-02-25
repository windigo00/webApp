<?php

namespace App\Model\Security;

use App\Model\Entity;

/**
 * @Entity
 * @Table(name="user_groups")
 **/
class UserGroup extends Entity {
	/** 
	 * @Id @Column(type="integer")
	 **/
	protected $id;
	/** @Column(type="string") **/
	protected $name;
}
