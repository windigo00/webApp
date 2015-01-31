<?php
namespace App\Modules\Front\Components;

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
		return parent::setParent('../navigation/breadcrumbs.latte');
	}
	
	public function render() {
		$this->template->breadcrumbs = array();
		parent::render();
	}

}
