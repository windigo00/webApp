<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * AclResources
 *
 * @ORM\Table(name="acl_resources")
 * @ORM\Entity
 */
class AclResources extends \App\Model\Entity
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
