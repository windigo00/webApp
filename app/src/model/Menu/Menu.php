<?php
namespace App\Model;
use App\Model\Catalog\Category;
/**
 * Menu model class
 */
class Menu {
	/** 
	 * @param string $path
	 * @return MenuItem
	 */
	public static function getByPath($path) {
		$attrs = array();
		if (!empty($path)) {
			$attrs['path'] = $path;
		} else {
			$attrs['parentId'] = 0;
		}
		return Category::findOneBy($attrs);
	}
	
}
