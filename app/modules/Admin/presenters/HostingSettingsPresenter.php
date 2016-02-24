<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\Admin\Presenters;

use App\Modules\Admin\Components\AdminTable,
	App\Model\Hosting
		;
/**
 * Description of HostingSettings
 *
 * @author KuBik
 */
class HostingSettingsPresenter extends SecureAdminPresenter {
	
	public function createComponentHostingList($name) {
		$grid = new AdminTable($this, $name);
		$grid->addColumnText('id', 'Id')->setSortable();
		$grid->addColumnText('domain', 'Domain')->setSortable()->setFilterText();
		$grid->addColumnText('users', 'User')->setCustomRender(function($item){
			$u = $item->users;
			$ret = array();
			foreach ($u as $user) {
				$ret[] = $user->nick;
			}
			return implode(', ', $ret);
		})->setSortable()->setFilterText();
		$grid->addColumnText('status', 'Status')->setSortable()->setFilterText();
		return $grid;
	}
	
	public function renderDefault() {
		$this['hostingList']->setModel(Hosting::getRepository()->createQueryBuilder('h'));
	}
}
