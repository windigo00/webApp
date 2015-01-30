<?php
namespace App\Model\Component;

use Nette,
	App\Model\EditableControl;

/**
 * Description of MenuComponent
 *
 * @author KuBik
 */
class MenuComponent extends EditableControl {
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
		
		$this->template->data = $data;
		
		parent::render();
	}

	protected function setTpl($tplFile = '') {
		return parent::setTpl('menu.latte');
	}

}
