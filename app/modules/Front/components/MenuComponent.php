<?php
namespace App\Modules\Front\Components;

use App\Model\Component
		;

/**
 * Description of MenuComponent
 *
 * @author KuBik
 */
class MenuComponent extends Component\MenuComponent {
	/**
	 *
	 * @var App\Model\Entity
	 */
	protected $data;
//	public function render() {
//		$data = func_get_args();
//		if (!empty($data)) {
//			$data = $data[0];
//		}
//		$params = $this->presenter->request->parameters;
//		$path = (!empty($params['category']) ? $params['category'].'/':'').
//				(!empty($params['name']) ? $params['name']:'');
//		$menu = Menu::getByPath($path);
//		$this->template->menu = $menu;
//		parent::render();
//	}

	protected function setTpl($tplFile = '') {
		return parent::setTpl('../componens/navigation.latte');
	}

	public function setup($param) {
		
	}

}
