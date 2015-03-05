<?php
namespace App\Modules\Shop\Components;

use App\Model\Menu
		;

/**
 * Description of MenuComponent
 *
 * @author KuBik
 */
class MenuComponent extends \App\Model\Component\MenuComponent {
	
	protected $data;
	public function render() {
		$params = $this->presenter->params;
//		dump($params);
		$path = (isset($params['category']) ? $params['category'].'/':'').
				(isset($params['name']) ? $params['name']:'');
		$menu = Menu::getByPath($path);
		$this->template->data = $menu;
		parent::render();
	}

	protected function setTpl($tplFile = '') {
		return parent::setTpl('menu.latte');
	}

	public function setup($param) {
		
	}

}
