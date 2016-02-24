<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\OneToMany,
	Doctrine\ORM\Mapping\ManyToMany,
	Doctrine\ORM\Mapping\JoinTable,
	Doctrine\ORM\Mapping\JoinColumn,
	Doctrine\ORM\Mapping\JoinColumns,
	Doctrine\Common\Collections\ArrayCollection
		;
/**
 * Users
 *
 * @Table(name="users")
 * @Entity
 */
class User extends AbstractModel {
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
     * @var \UserGroupAssignment
	 * 
	 * @ManyToMany(targetEntity="App\Model\Security\UserGroup", inversedBy="users")
     * @JoinTable(name="user_group_assignment",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="group_id", referencedColumnName="id")}
	 * )
     */
	protected $groups;
	/**
     * @ManyToMany(targetEntity="Hosting", mappedBy="users")
     */
	protected $hostings;
	
	public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->hostings = new ArrayCollection();
    }
	
	public function getName() {
		return $this->firstname.' '.$this->lastname;
	}
	
	public function getGroups() {
		$arr = array();
		foreach ($this->groups as $group) {
			$arr[] = $group->getId();
		}
		return $arr;
	}
	public function getData() {
		return array('id'=>  $this->entity->getId(),'nick' => $this->entity->getNick());
	}
}
