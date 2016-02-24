<?php

namespace App\Modules\Admin\Presenters;

use App\Presenters\SecurePresenter,
	App\Modules\Admin\Components\TopMenu,
	App\Modules\Admin\Components\LeftMenu,
	App\Modules\Admin\Components\Breadcrumbs
		;

/**
 * Description of BaseAdminPresenter
 *
 * @author KuBik
 */
abstract class BaseAdminPresenter extends SecurePresenter
{
	/**
	 * Generates URL to presenter, action or signal.
	 * @param  string   destination in format "[//] [[[module:]presenter:]action | signal! | this] [#fragment]"
	 * @param  array|mixed
	 * @return string
	 * @throws InvalidLinkException
	 */
	public function link($destination, $args = array()) {
		$tmp = strpos($destination, ':');
		if ($tmp > 0) {
			list($name, $action) = explode(':', $destination);
		} elseif ($tmp === 0) {
			$name = $this->name;
			$action = substr($destination, 1);
		} else {
			$name = $this->name;
			if ($destination == 'this') {
				$action = NULL;
			} else {
				$action = preg_replace('#([\!\#])*#', '', $destination);
			}
		}
		$name = (strpos($name, 'Admin:') === FALSE ? 'Admin:' : '').$name;
		$action = empty($action) ? 'default' : $action;
		$allowed = $this->user->isAllowed($name, $action);
		if (!$allowed) {
//			$destination = 'Security:notAllowed';
//			\Tracy\Debugger::barDump($destination);
			return '#';
		} else {
			return parent::link($destination, $args);
		}
	}
	
	protected function createComponentTopMenu() {
		$menu = new TopMenu;
		return $menu;
	}
	protected function createComponentLeftMenu() {
		$menu = new LeftMenu;
		return $menu;
	}
	protected function createComponentBreacrumbs() {
		$menu = new Breadcrumbs;
		return $menu;
	}
}
