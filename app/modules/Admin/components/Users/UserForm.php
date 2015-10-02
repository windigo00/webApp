<?php
namespace App\Modules\Admin\Components;

/**
 * Description of UserForm
 *
 * @author KuBik
 */
class UserForm extends AdminControl {
	
	use \App\Model\Traits\ModelGetSetTrait;

	protected $resource;
	
	public function __construct($resource) {
		parent::__construct();
		$this->resource = $resource;
	}
	
	protected function setTpl($tplFile = '') {
		return parent::setTpl('users/form.latte');
	}

	public function setup($param) {
		
	}

}
