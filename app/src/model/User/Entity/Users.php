<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users extends \App\Model\Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
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
     * @var \UserGroupAssignment
	 * 
	 * @ORM\ManyToMany(targetEntity="UserGroups")
     * @ORM\JoinTable(name="user_group_assignment",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     *      )
     */
	protected $groups;
	
//	public function __construct()
//    {
//		parent::__construct();
//        $this->groups = new ArrayCollection();
//    }
}
