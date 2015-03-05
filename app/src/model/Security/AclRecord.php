<?php
namespace App\Model\Security;

use App\Model\Entity;
/**
 * Description of AclRecord
 *
 * @author KuBik
 * 
 * @Entity
 * @Table(name="acl_records")
 **/
class AclRecord extends Entity {
	
	/** 
	 * @Id @Column(type="integer")
	 * @GeneratedValue 
	 **/
	protected $id;
	/**
	 * @OneToOne(targetEntity="AclResource")
	 * @JoinColumn(name="resource", referencedColumnName="name")
	 **/
	protected $resource;
	/**
	 * @OneToOne(targetEntity="AclPrivilege")
	 * @JoinColumn(name="privilege", referencedColumnName="name")
	 **/
	protected $privilege;
	/**
	 * @OneToOne(targetEntity="UserGroup")
	 * @JoinColumn(name="user_group", referencedColumnName="id")
	 **/
	protected $group;
	/** @Column(type="boolean") **/
	protected $allowed;
}
