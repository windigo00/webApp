<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserGroupAssignment
 *
 * @ORM\Table(name="user_group_assignment")
 * @ORM\Entity
 */
class UserGroupAssignment extends \App\Model\Entity
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
     * @var \UserGroups
     *
     * @ORM\ManyToOne(targetEntity="UserGroups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * })
     */
    protected $group;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    protected $user;


}
