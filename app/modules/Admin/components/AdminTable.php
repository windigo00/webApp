<?php
namespace App\Modules\Admin\Components;

use Grido\Components\Filters\Filter,
	Grido\Grid;
/**
 * Description of AdminTable
 *
 * @author KuBik
 */
class AdminTable extends Grid {
	
	public function __construct(\Nette\ComponentModel\IContainer $parent = NULL, $name = NULL) {
		parent::__construct($parent, $name);
//		$this->setTemplateFile('../app/design/admin/metro/components/Grid2.latte');
		$this->getTablePrototype()->class[] = 'table table-striped table-bordered bootstrap-datatable datatable dataTable';
		if ($parent->user->isAllowed($parent->name, 'edit')){
			$this->addActionHref('edit', '')->setIcon('edit');
		}
		elseif ($parent->user->isAllowed($parent->name, 'view')){
			$this->addActionHref('view', '')->setIcon('zoom-in');
		}
		if ($parent->user->isAllowed($parent->name, 'delete')){
			$this->addActionHref('delete', '')->setIcon('trash')->setConfirm(function($item) {
				return "Are you sure you want to delete it?";
			});
		}
		$this->filterRenderType = Filter::RENDER_OUTER;
		$this->setDefaultPerPage(9999);
	}
	
//	protected function setTpl($tplFile = '') {
//		$this->template->table = $this->data;
//		return parent::setTpl('table.latte');
//	}
}
