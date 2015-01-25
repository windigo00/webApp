<?php

namespace App\Modules\Admin\Presenters;

use Nette,
	App\Model,
	App\Model\Presenters\BasePresenter,
	App\Modules\Admin\Components\TopMenu,
	App\Modules\Admin\Components\LeftMenu
		;

/**
 * Description of BaseAdminPresenter
 *
 * @author KuBik
 */
abstract class BasePresenterAdmin extends BasePresenter{
	protected function createComponentTopMenu() {
		$menu = new TopMenu();
		return $menu;
	}
	protected function createComponentLeftMenu() {
		$menu = new LeftMenu();
		return $menu;
	}
	
	protected function beforeRender() {
		parent::beforeRender();
		$this->template->setTranslator(\App\Model\Translator::get());
	}
}
