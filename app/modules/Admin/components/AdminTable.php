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
	protected function setTpl() {
		$this->template
			->setFile(dirname(__DIR__).'/templates/components/table.latte');
		$this->template->table = $this->data;
	}
}
