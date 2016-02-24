<?php
namespace App\Model\Security;

use App\Model\AbstractModel,
	Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\ManyToMany,
	Doctrine\ORM\Mapping\JoinTable,
	Doctrine\Common\Collections\ArrayCollection
	;
/**
 * UserGroup
 *
 * @Table(name="user_groups")
 * @Entity
 */
class UserGroup extends AbstractModel {
	/**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(name="name", type="string", length=30, nullable=false)
     */
    protected $name;
	
	/**
     * Bidirectional - Many Users are in one Group (OWNING SIDE)
     *
     * @ManyToMany(targetEntity="App\Model\User", mappedBy="groups")
     */
	protected $users;
	
	public function __construct()
    {
        $this->users = new ArrayCollection();
    }
}
