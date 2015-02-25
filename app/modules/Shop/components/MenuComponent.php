<?php
namespace App\Modules\Shop\Components;

use Nette,
	Nette\Environment,
	App\Model\Menu\Menu
		;

/**
 * Description of MenuComponent
 *
 * @author KuBik
 */
class MenuComponent extends \App\Model\Component\MenuComponent {
	
	protected $data;
	public function render() {
		$data = func_get_args();
		if (!empty($data)) {
			$data = $data[0];
		}
		$params = $this->presenter->request->parameters;
		$path = (!empty($params['category']) ? $params['category'].'/':'').
				(!empty($params['name']) ? $params['name']:'');
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
