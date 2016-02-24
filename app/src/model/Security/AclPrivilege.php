<?php
namespace App\Model\Security;
use App\Model\AbstractModel,
	Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue
		;

/**
 * AclPrivileges
 *
 * @Table(name="acl_privileges")
 * @Entity
 */
class AclPrivilege extends AbstractModel {
	/**
     * @var string
     *
     * @Column(name="name", type="string", length=60, nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $name;
}
