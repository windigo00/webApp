<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Component;

use Nette,
	App\Model\EditableControl;

/**
 * Description of TableComponent
 *
 * @author KuBik
 */
abstract class TableComponent extends EditableControl {
	
	/**
	 *
	 * @var App\Model\DBObject
	 */
	protected $data;
	public function render() {
		$data = func_get_arg(0);
		$this->data = $data;
		$this->template->title = 'Stored documents';
		$this->template->rows = $data;
		$this->template->header = array();
		if (!empty($data)) {
			$first = reset($data);
			$this->template->header = array_keys($first->getRecord()->toArray());
		}
//		while(TRUE) {
//			$i = $this->data[1]->getTable();
//			var_dump($i);exit;
//			$this->template->header[] = $i;
//		}
		parent::render();
	}
	
	
//	abstract protected function setTpl();

}
