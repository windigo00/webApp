<?php
namespace App\Admin\Model;

use Nette\Security\Identity;

/**
 * @Entity
 * @Table(name="user-email")
 **/
class Email extends \App\Model\Model {
	/** 
	 * @Id @Column(type="integer")
	 **/
	protected $id;
	
	/** @Column(type="string") **/
	protected $content;
	
	/** @Column(type="datetimetz") **/
	protected $recieved;
	/** @Column(type="boolean") **/
	protected $vieved;
	
	/**
     * @OneToOne(targetEntity="User", inversedBy="mails")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;
	
	public static function findNewByUser(Identity $user) {
//		$qb = self::getRepository()->createQueryBuilder('e');
//		$qb->
		$emails = null;
		return $emails;
	}
}
