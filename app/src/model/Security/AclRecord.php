<?php
namespace App\Model\Security;

use App\Model\AbstractModel,
	Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\ManyToOne,
	Doctrine\ORM\Mapping\JoinColumn,
	Doctrine\ORM\Mapping\JoinColumns,
	Doctrine\Common\Collections\ArrayCollection
		;
/**
 * AclRecords
 *
 * @Table(name="acl_records")
 * @Entity
 */
class AclRecord extends AbstractModel {
	/**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var boolean
     *
     * @Column(name="allowed", type="boolean", nullable=false)
     */
    protected $allowed;

    /**
     * @var \AclPrivileges
     *
     * @ManyToOne(targetEntity="AclPrivilege")
     * @JoinColumns({
     *   @JoinColumn(name="privilege", referencedColumnName="name")
     * })
     */
    protected $privilege;

    /**
     * @var \AclResources
     *
     * @ManyToOne(targetEntity="AclResource")
     * @JoinColumns({
     *   @JoinColumn(name="resource", referencedColumnName="name")
     * })
     */
    protected $resource;

    /**
     * @var \UserGroups
     *
     * @ManyToOne(targetEntity="UserGroup")
     * @JoinColumns({
     *   @JoinColumn(name="user_group", referencedColumnName="id")
     * })
     */
    protected $userGroup;
}
