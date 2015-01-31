<?php
namespace App\Modules\Admin\Components;

use App\Model\Component\TableComponent
	;
/**
 * Description of AdminTable
 *
 * @author KuBik
 */
class AdminTable extends TableComponent {
	protected function setTpl($tplFile = '') {
		$this->template->table = $this->data;
		return parent::setTpl('table.latte');
	}
}
