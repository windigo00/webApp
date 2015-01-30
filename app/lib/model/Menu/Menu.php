<?php
namespace App\Model\Menu;

use Nette,
	App\Model\DBObject,
	App\Model\SitePath
		;
/**
 * Description of Menu
 *
 * @author KuBik
 */
class Menu extends DBObject {
	const 
		TABLE_NAME = 'menu_site_path',

		COLUMN_MENU_ID = 'menu_id',
		COLUMN_PATH_ID = 'site_path_id'
			;

	/**
	 * 
	 * @param string $path
	 * @return MenuItem
	 */
	public static function getByPath($path) {
		$sql = 'SELECT '.static::TABLE_NAME.'.'.static::COLUMN_MENU_ID.' FROM '.static::TABLE_NAME.' '
			. 'LEFT JOIN '.SitePath::TABLE_NAME.' ON '.SitePath::TABLE_NAME.'.'.SitePath::COLUMN_ID.' = '.static::TABLE_NAME.'.'.static::COLUMN_PATH_ID.' '
			. 'WHERE '.SitePath::TABLE_NAME.'.'.SitePath::COLUMN_PATH.' = \''.$path.'\';';
//		echo $sql;
		$res = static::getDB()->query($sql);
		if ($res->getRowCount() > 0) {
			$res = $res->fetch();
			$res = MenuItem::getById($res[static::COLUMN_MENU_ID]);
		} else {
			$res = NULL;
		}
		return $res;
	}
	/**
	 * 
	 * @param int $parent
	 */
	public static function getByParentId($parent = NULL) {
		$menu = MenuItem::getTable()->where(MenuItem::COLUMN_PARENT.(is_null($parent)?' IS NULL' : '='.$parent));
		$out = array();
		while ($tmp = $menu->fetch()) {
			$out[] = new MenuItem($tmp);
		}
		return $out;
	}
	/**
	 * 
	 * @param \App\Model\Menu\MenuItem $parent
	 * @return \App\Model\Menu\MenuItem
	 */
	public static function getByParent(MenuItem $parent = NULL) {
		$menu = MenuItem::getTable()->where(MenuItem::COLUMN_PARENT.(is_null($parent)?' IS NULL' : '='.$parent->getParentId()));
		$out = array();
		while ($tmp = $menu->fetch()) {
			$out[] = new MenuItem($tmp);
		}
		return $out;
	}
}
