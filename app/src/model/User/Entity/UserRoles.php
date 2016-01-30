<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="user_roles")
 * @ORM\Entity
 */
class UserRoles extends \App\Model\Entity
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
     * @var string
     *
     * @ORM\Column(name="nick", type="string", length=255, nullable=false)
     */
    protected $nick;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="pwd", type="string", length=1024, nullable=false)
     */
    protected $pwd;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=128, nullable=true)
     */
    protected $mail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    protected $active;

	/**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="UserGroups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="user_id")
     * })
     */
	protected $groups;
}
