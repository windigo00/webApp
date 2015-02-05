<?php
namespace App\Modules\Admin\Components;

use Grido\DataSources\Doctrine,
	App\Model\User,
	Grido\Grid
		;
/**
 * Description of UserList
 *
 * @author KuBik
 */
class UserList extends AdminControl {
	
	protected function setTpl($tplFile = '') {
		return parent::setTpl('users/list.latte');
	}
	
	public function render() {
		
		parent::render();
	}
}
