<?php
namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection,
	App\Model\Entity,
	App\Model\Security\UserGroup
		;
/**
 * @Entity
 * @Table(name="users")
 **/
class User extends Entity {
	/** 
	 * @Id @Column(type="integer")
	 * @GeneratedValue 
	 **/
	protected $id;
	/** @Column(type="string") **/
	protected $nick;
	/** @Column(type="string") **/
	protected $firstname;
	/** @Column(type="string") **/
	protected $lastname;
	/** @Column(type="string") **/
	protected $mail;
	/** @Column(type="string", name="`pwd`") **/
	protected $password;
	/** @Column(type="boolean") **/
	protected $active;
	/**
     * @ManyToMany(targetEntity="App\Model\Security\UserGroup")
     * @JoinTable(name="user_group_assignment",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="group_id", referencedColumnName="id")}
     *      )
     **/
	protected $roles;
	public function __construct() {
		$this->roles = new ArrayCollection();
	}
	
	public function getName() {
		return $this->firstname.' '.$this->lastname;
	}
}
