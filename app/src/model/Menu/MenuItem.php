<?php
namespace App\Model\Menu;

use Doctrine\ORM\Mapping AS ORM,
	Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of MenuItem
 * @ORM\Entity
 * @Table(name="menu")
 * @author KuBik
 */
class MenuItem {
//	const 
//		TABLE_NAME = 'menu',
//
//		COLUMN_NAME		= 'name',
//		COLUMN_PARENT	= 'parent_id'
//			;
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
		$sql = 'SELECT * FROM ';
	}
	
	/**
	 * @return array<MenuItem>
	 */
	public function getChildren() {
		$res = static::getTable()->where(static::COLUMN_PARENT.'='.$this->getId());
		$ret = array();
		while($tmp = $res->fetch()) {
			$ret[] = MenuItem::getById($tmp[static::COLUMN_ID]);
		}
		return $ret;
	}
	public function setParent(MenuItem $item) {
		$this->parent = $item;
		$this->setParentId($item->getId());
	}
	public function getParent() {
		if (empty($this->parent)) {
			$this->parent = static::getById($this->getParentId());
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
