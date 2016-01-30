<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * AclPrivileges
 *
 * @ORM\Table(name="acl_privileges")
 * @ORM\Entity
 */
class AclPrivileges extends \App\Model\Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $name;


}
