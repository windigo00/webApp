<?php
namespace App\Model;
use App\Model\Catalog\Category;
/**
 * Menu model class
 */
class Menu extends \App\Model\Model {
	protected static $entityClass = '\App\Model\Entities\Menu';
	
	protected $items;


	/** 
	 * @param string $path
	 * @return MenuItem
	 */
	public static function getByPath($path) {
//		$attrs = array();
//		if (!empty($path)) {
//			$attrs['path'] = $path;
//		} else {
//			$attrs['parentId'] = 0;
//		}
//		return Category::findOneBy($attrs);
		$sel = Menu\MenuItem::findBy(array('path'=> '/'.$path));
		/**
		 * @var \Doctrine\ORM\EntityManager
		 */
//		$sel = self::getRepository()->findByPath($path);
//		foreach($sel as $tmp){
			dump($sel);
//		}
		return $sel;
	}
	public function init() {
		$items = $this->getItems();
		foreach ($items as $item) {
			$item->getChildren(TRUE);
		}
	}
	/**
	 * 
	 * @return array<Menu\MenuItem>
	 */
	public function getItems() {
		if ($this->items === NULL) {
			$this->items = Menu\MenuItem::findBy(array('menu'=> $this->id, 'parent' => NULL));
		}
		return $this->items;
	}
	
}
