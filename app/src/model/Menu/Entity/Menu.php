<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="cms_menu")
 * @ORM\Entity
 */
class Menu extends \App\Model\Entity
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
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;
	/**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    protected $module;
	/**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $active;

}
