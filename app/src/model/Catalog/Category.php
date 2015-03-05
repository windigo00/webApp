<?php
namespace App\Model\Catalog;

use App\Model\Eav\EavAttributeSet
		;

/**
 * Description of Category
 *
 * @author KuBik
 */
class Category extends \App\Model\Model
{
	protected static $entityClass = '\App\Model\Entities\CatalogCategoryEntity';
	
	public function __get($name) {
		try {
			$ret = parent::__get($name);
		} catch (\Exception $ex) {
			$ret = $this->getAttribute($name);
		}
		
	}
	
	public function hasChildren() {
		return $this->childrenCount > 0;
	}
	protected $children;
	public function getChildren() {
		if ($this->children === NULL) {
			$id = $this->entity->entityId;
			$this->children = self::findBy(array('parentId'=>($id ? $id :0)));
		}
		return $this->children;
	}
	
	protected $attributes;
	public function getAttribute($name) {
		if (isset($this->attributes[$name])) {
			return $this->attributes[$name];
		} else {
			$this->loadAttributes();
			if (isset($this->attributes[$name])) {
				return $this->attributes[$name];
			}
		}
		return NULL;
	}
	
	protected function loadAttributes() {
		$this->attributes = EavAttributeSet::getAttributesFor(
			get_called_class(), 
			$this->entity->attributeSetId
		);
	}
}
