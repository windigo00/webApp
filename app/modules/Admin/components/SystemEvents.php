<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\Admin\Components;

use App\Model\SystemEvent;

/**
 * Description of SystemEvents
 *
 * @author KuBik
 */
class SystemEvents extends AdminControl{
	protected function setTpl($tplFile = '') {
		return parent::setTpl('sysevents.latte');
	}

	public function setup($param) {
		parent::setup($param);
		$items = SystemEvent::findAll();
		
		$this->template->items = $items;
	}
	
	public function handleRefresh() {
//		dump(func_get_args());
		$this->invalidateControl();
	}
}
