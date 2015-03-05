<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * AclRecords
 *
 * @ORM\Table(name="acl_records")
 * @ORM\Entity
 */
class AclRecords extends \App\Model\Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allowed", type="boolean", nullable=false)
     */
    protected $allowed;

    /**
     * @var \AclPrivileges
     *
     * @ORM\ManyToOne(targetEntity="AclPrivileges")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="privilege", referencedColumnName="name")
     * })
     */
    protected $privilege;

    /**
     * @var \AclResources
     *
     * @ORM\ManyToOne(targetEntity="AclResources")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource", referencedColumnName="name")
     * })
     */
    protected $resource;

    /**
     * @var \UserGroups
     *
     * @ORM\ManyToOne(targetEntity="UserGroups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_group", referencedColumnName="id")
     * })
     */
    protected $userGroup;


}
