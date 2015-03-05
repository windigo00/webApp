<?php
namespace App\Modules\Admin\Components;

use App\Admin\Model\Email;
/**
 * Description of MessageMenu
 *
 * @author KuBik
 */
class MessageMenu extends AdminControl {

	protected function setTpl($tplFile = '') {
		return parent::setTpl('messages.latte');
	}

	public function setup($param) {
		$items = Email::findNewByUser($this->presenter->user);
		
		$this->template->items = $items;
	}
	
	public function handleRefresh() {
//		dump(func_get_args());
		$this->invalidateControl();
	}

}
