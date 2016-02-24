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
 * AclResources
 *
 * @Table(name="acl_resources")
 * @Entity
 */
class AclResource extends AbstractModel {
	/**
     * @var string
     *
     * @Column(type="string", length=60, nullable=false)
     * @Id
     */
    protected $name;
}
