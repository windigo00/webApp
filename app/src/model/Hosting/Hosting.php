<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\ManyToMany,
	Doctrine\ORM\Mapping\JoinColumn,
	Doctrine\ORM\Mapping\JoinTable,
	Doctrine\Common\Collections\ArrayCollection
		;
/**
 * Documents
 *
 * @Table(name="hostings")
 * @Entity
 */
class Hosting extends AbstractModel {
	/**
     * @var integer
     *
     * @Column(type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
	
	/**
     * @var string
     *
     * @Column(type="string", length=255, nullable=false)
     */
    protected $domain;

	/**
     * @ManyToMany(targetEntity="User", inversedBy="hostings")
     * @JoinTable(name="user_hosting")
	 */
	protected $users;

	/**
     * @var boolean
     *
     * @Column(type="boolean", nullable=false)
     */
    protected $status;
	
	public function __construct() {
		$this->users = new ArrayCollection();
	}
}
