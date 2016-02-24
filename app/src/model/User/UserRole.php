<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\OneToMany,
	Doctrine\Common\Collections\ArrayCollection
		;
/**
 * Users
 *
 * @Table(name="user_roles")
 * @Entity
 */
class UserRole extends AbstractModel {
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
     * @Column(name="nick", type="string", length=255, nullable=false)
     */
    protected $nick;

    /**
     * @var string
     *
     * @Column(name="firstname", type="string", length=255, nullable=true)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @Column(name="lastname", type="string", length=255, nullable=true)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @Column(name="pwd", type="string", length=1024, nullable=false)
     */
    protected $pwd;

    /**
     * @var string
     *
     * @Column(name="mail", type="string", length=128, nullable=true)
     */
    protected $mail;

    /**
     * @var boolean
     *
     * @Column(name="active", type="boolean", nullable=false)
     */
    protected $active;

	/**
     * @var \Users
     *
     * @ManyToOne(targetEntity="UserGroups")
     * @JoinColumns({
     *   @JoinColumn(name="id", referencedColumnName="user_id")
     * })
     */
	protected $groups;
}
