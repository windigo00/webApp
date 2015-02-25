<?php
namespace App\Modules\Shop\Components;

use Nette,
	Nette\Environment,
	App\Model\TranslatedControl
		;
/**
 * Description of FrontBreadcrumbs
 *
 * @author KuBik
 */
class Breadcrumbs extends TranslatedControl {
	
	protected function setTpl($tplFile = '') {
		return parent::setTpl('breadcrumbs.latte');
	}
	
	public function render() {
		$this->template->breadcrumbs = array();
		parent::render();
	}

	public function setup($param) {
		
	}

}
