<?php
namespace App\Model\Menu;

/**
 * Description of MenuItem
 * @author KuBik
 */
class MenuItem extends \App\Model\Model {
	protected static $entityClass = '\App\Model\Entities\MenuItem';
	protected $parent;
	protected $children;
	protected $childrenIds;
	/**
	 * 
	 * @return MenuItem
	 */
	public function getRoot() {
		$tmp = $this;
		while ($tmp->getParentId() != NULL) {
			$tmp = $tmp->getParent();
		}
		return $tmp;
	}
	
	public function getPath() {
//		$sql = 'SELECT * FROM ';
	}
	
	
	public function hasChildren() {
		return !empty($this->getChildren());
	}
	
	/**
	 * @return array<MenuItem>
	 */
	public function getChildren($recursive = FALSE) {
		if ($this->children === NULL) {
			$res = MenuItem::findBy(array('menu'=> $this->menu->id, 'parent' => $this->id));
			$this->children = array();
			foreach ($res as $child) {
				$this->children[] = $child;
				if ($recursive) {
					$child->getChildren();
				}
			}
		}
		return $this->children;
	}
	public function setParent(MenuItem $item) {
		$this->parent = $item->getEntity();
	}
	public function getParent() {
		if (empty($this->parent)) {
			$this->parent = static::get($this->getParentId());
		}
		return $this->parent;
	}
	public function setParentId($parentId) {
		$this->set(static::COLUMN_PARENT, $parentId);
	}
	public function getParentId() {
		return $this->get(static::COLUMN_PARENT);
	}
	
	public function setName($name) {
		$this->set(static::COLUMN_NAME, $name);
	}
	public function getName() {
		return $this->get(static::COLUMN_NAME);
	}
}
