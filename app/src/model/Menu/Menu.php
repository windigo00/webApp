<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\OneToMany,
	App\Model\Catalog\Category,
	Doctrine\Common\Collections\ArrayCollection
		;
/**
 * Menu
 *
 * @Table(name="cms_menu")
 * @Entity
 */
class Menu extends AbstractModel {
	
	/**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(type="string", length=255, nullable=false)
     */
    protected $name;
	/**
     * @var string
     *
     * @Column(type="string", length=10, nullable=false)
     */
    protected $module;
	/**
     * @var boolean
     *
     * @Column(type="boolean", nullable=false)
     */
    protected $active;
	/**
	 *
	 * @var MenuItems
	 * 
     * @OneToMany(targetEntity="MenuItem", mappedBy="menu")
	 */
	protected $items;
	
	public function __construct() {
        $this->items = new ArrayCollection();
    }
	/** 
	 * @param string $path
	 * @return MenuItem
	 */
//	public static function getByPath($path) {
//		$attrs = array();
//		if (!empty($path)) {
//			$attrs['path'] = $path;
//		} else {
//			$attrs['parentId'] = 0;
//		}
//		return Category::findOneBy($attrs);
//		$sel = Menu\MenuItem::findBy(array('path'=> '/'.$path));
		/**
		 * @var \Doctrine\ORM\EntityManager
		 */
//		$sel = self::getRepository()->findByPath($path);
//		foreach($sel as $tmp){
//			dump($sel);
//		}
//		return $sel;
//	}
//	public function init() {
//		$items = $this->getItems();
//		foreach ($items as $item) {
//			$item->getChildren(TRUE);
//		}
//	}
	/**
	 * 
	 * @return array<Menu\MenuItem>
	 */
	public function getRootMenuItems() {
		$items = array();
		if ($this->items->count()) {
			$items = $this->items->filter(function(MenuItem $entry){ return $entry->parent === NULL; });
//					= Menu\MenuItem::findBy(array('menu'=> $this->id, 'parent' => NULL));
		}
		return $items;
	}
	
}
