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
		$this->getTablePrototype()->class[] = 'table table-striped table-bordered bootstrap-datatable datatable';
		$act;
		if ($parent->user->isAllowed($parent->name, 'edit')){
			$act = $this->addActionHref('edit', 'Edit');
			$act->getElementPrototype()->class('btn btn-info')->setHtml('<i class="halflings-icon white edit"></i>');
		}
		elseif ($parent->user->isAllowed($parent->name, 'view')){
			$act = $this->addActionHref('view', 'View');
			$act->getElementPrototype()->class('btn btn-success')->setHtml('<i class="halflings-icon white zoom-in"></i>');
			
		}
		if ($parent->user->isAllowed($parent->name, 'delete')){
			$act = $this->addActionHref('delete', 'Delete');
			$act->getElementPrototype()->class('btn btn-danger')->setHtml('<i class="halflings-icon white trash"></i>');
			$act->setConfirm(function($item) {
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
