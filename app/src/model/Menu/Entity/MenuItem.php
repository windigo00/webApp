<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="cms_menu_item")
 * @ORM\Entity
 */
class MenuItem extends \App\Model\Entity
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
	 *
	 * @var Menu
	 * 
     * @ORM\OneToOne(targetEntity="Menu")
     * @ORM\JoinColumn(name="menu_id", referencedColumnName="id")
	 */
	protected $menu;
	/**
	 * @var MenuItem Parent Item
	 * 
     * @ORM\OneToOne(targetEntity="MenuItem")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     **/
	protected $parent;

	/**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $active;
	/**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $text;
	/**
     * @var string
     *
     * @ORM\Column(type="string", length=1024, nullable=false)
     */
    protected $path;


}
