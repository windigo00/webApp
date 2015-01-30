<?php
namespace App\Model;

use Nette,
	Nette\Security\Passwords,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\Common\Collections\ArrayCollection
		;

/**
 * @Entity(repositoryClass="App\Model\UserRepository")
 * @Table(name="user")
 **/
class User extends \App\Model\Entity{
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
	protected $surname;
	/** @Column(type="string") **/
	protected $mail;
	/** @Column(type="string", name="`pwd`") **/
	protected $password;
	/** @Column(type="string") **/
	protected $usr_link;
	/** @Column(type="boolean") **/
	protected $active;
	/** @Column(type="string") **/
	protected $rights;
	/** @Column(type="string") **/
	protected $role;
	
	public $needRehash = false;

}

class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllAdminUsers()
    {
        return $this->_em->createQuery('SELECT u FROM MyDomain\Model\User u WHERE u.status = "admin"')
                         ->getResult();
    }
}