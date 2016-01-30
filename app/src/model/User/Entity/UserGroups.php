<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserGroups
 *
 * @ORM\Table(name="user_groups")
 * @ORM\Entity
 */
class UserGroups extends \App\Model\Entity
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
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    protected $name;


}
