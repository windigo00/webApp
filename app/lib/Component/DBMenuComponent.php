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
 * Description of MenuComponent
 *
 * @author KuBik
 */
class MenuComponent extends EditableControl {
	const TPL_PATH = '/../../FrontModule/templates/';
	/**
	 *
	 * @var App\Model\DBObject
	 */
	protected $data;
	public function render() {
		$data = func_get_args();
		if (!empty($data)) {
			$data = $data[0];
		}
		
		$this->template->data = $data;
		
		parent::render();
	}

	protected function setTpl() {
		$this->template
			->setFile(static::getFilePath('components/menu.latte', __DIR__));
//		$this->template->table = array_keys($this->data->fetchPairs());
	}

}
