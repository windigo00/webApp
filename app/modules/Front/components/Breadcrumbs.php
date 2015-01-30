<?php
namespace App\Modules\Front\Model\Component;

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
	
	protected function setTpl() {
		$this->template->setFile($this->getTplPath(Environment::getContext()->parameters['templates'].'navigation/breadcrumbs.latte'));
	}
	
	public function render() {
		$this->template->breadcrumbs = array();
		parent::render();
	}

}
