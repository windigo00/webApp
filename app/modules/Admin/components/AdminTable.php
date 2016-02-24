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
			$act->getElementPrototype()->title('Grido.Edit')
					->class('btn btn-small btn-info')
					->setHtml('<i class="halflings-icon white edit"></i>');
		}
		elseif ($parent->user->isAllowed($parent->name, 'view')){
			$act = $this->addActionHref('view', 'View');
			$act->getElementPrototype()->title('Grido.View')
					->class('btn btn-small btn-success')
					->setHtml('<i class="halflings-icon white zoom-in"></i>');
		}
		if ($parent->user->isAllowed($parent->name, 'delete')){
			$act = $this->addActionHref('delete', 'Delete');
			$act->getElementPrototype()->title('Grido.Delete')
					->class('btn btn-small btn-danger')
					->setHtml('<i class="halflings-icon white trash"></i>');
			$act->setConfirm(function($item) {
				return "Are you sure you want to delete it?";
			});
		}
		$this->filterRenderType = Filter::RENDER_INNER;
		$this->setTranslator(\App\Model\Translator::get());
		$tpl = $this->getTemplate();
		$tplPath = $parent->context->parameters['appDir']. $parent->context->parameters['templates'];
		
		$path = realpath($tplPath.'components'.DIRECTORY_SEPARATOR.'admin-tpl');
		$tpl->setFile($path .'/default.latte');
		
//		$this->setOperation(array('delete'=> 'Grido.Delete', 'update' => 'Grido.Update'), 'handleOperation')->setConfirm('delete', 'Are you sure?');
		
		$this->setDefaultPerPage(10);
	}
	
	public function addFilterDateRange($name, $label) {
		$ret = new \App\Components\DateRange($this, $name, $label);
		return $ret;
	}
	
//	protected function setTpl($tplFile = '') {
//		$this->template->table = $this->data;
//		return parent::setTpl('table.latte');
//	}
}
