<?php
namespace App\Admin\Model;

use Doctrine\ORM\Mapping AS ORM;

/**
 * Description of Language
 * @ORM\Entity
 * @Table(name="langs")
 * @author KuBik
 */
class Language
{
	use \App\Model\Language;
	/** 
	 * @Id @Column(type="integer")
	 * @GeneratedValue 
	 **/
	protected $id;
	/** @Column(type="string") **/
	protected $code;
	/** @Column(type="string") **/
	protected $name;
}
