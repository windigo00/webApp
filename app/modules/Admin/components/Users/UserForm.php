<?php
namespace App\Modules\Admin\Components;

/**
 * Description of UserForm
 *
 * @author KuBik
 */
class UserForm extends AdminControl {
	
	protected function setTpl($tplFile = '') {
		return parent::setTpl('users/form.latte');
	}

	public function setup($param) {
		
	}

}
