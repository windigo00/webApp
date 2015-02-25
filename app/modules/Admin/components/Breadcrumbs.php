<?php
namespace App\Modules\Admin\Components;

/**
 * Description of FrontBreadcrumbs
 *
 * @author KuBik
 */
class Breadcrumbs extends AdminControl {
	
	protected function setTpl($tplFile = '') {
		return parent::setTpl('../components/breadcrumbs.latte');
	}
	
	protected function findPath($presenter, $menu) {
		foreach ($menu as $item) {
			if (isset($item['presenter']) && $item['presenter'] == $presenter) {
				return array($item);
			}
			if (isset($item['items'])) {
				$ret = $this->findPath($presenter, $item['items']);
				if (!empty($ret)) {
//					if (isset($item['presenter'])) {
						return array_merge(array($item), $ret);
//					}
				}
			}
		}
		return NULL;
	}

	public function render() {
		$data = \App\Configs\AppConfig::getParameter('menu');
		$p = explode(':', $this->presenter->name);
		$path = $this->findPath($p[1], $data);
		$this->template->items = $path;
		parent::render();
	}

	public function setup($param) {}

}
