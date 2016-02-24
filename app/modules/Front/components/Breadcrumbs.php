<?php
namespace App\Modules\Front\Components;

/**
 * Description of FrontBreadcrumbs
 *
 * @author KuBik
 */
class Breadcrumbs extends ComponentFront {
	
	protected function setTpl($tplFile = '') {
		return parent::setTpl('navigation/breadcrumbs.latte');
	}
	
	public function render() {
		$this->template->breadcrumbs = array();
		parent::render();
	}

	public function setup($param) {
		
	}

}
