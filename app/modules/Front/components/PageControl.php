<?php
namespace App\Modules\Front\Components;

/**
 * Description of PageControl
 *
 * @author KuBik
 */
class PageControl extends ComponentFront {
	
	protected $data;

	protected function setTpl($tplFile = '') {
		parent::setTpl('page.latte');
	}
	
	public function setup($data) {
		$this->template->data = $data;
	}

}
