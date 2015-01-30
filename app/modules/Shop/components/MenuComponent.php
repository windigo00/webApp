<?php
namespace App\Modules\Front\Model\Component;

use Nette,
	Nette\Environment,
	App\Model\Menu\Menu
		;

/**
 * Description of MenuComponent
 *
 * @author KuBik
 */
class MenuComponent extends App\Model\Component\MenuComponent {
//	const TPL_PATH = '/../../../../design/default/navigation/';
	/**
	 *
	 * @var App\Model\DBObject
	 */
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
		$this->template->menu = $menu->getRoot();
		parent::render();
	}

	protected function setTpl() {
		$this->template->setFile($this->getTplPath(Environment::getContext()->parameters['templates'].'navigation/menu.latte'));
	}

}
