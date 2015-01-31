<?php

namespace App\Modules\Admin\Presenters;

use Nette,
	App\Model,
	App\Model\Presenters\SecurePresenter,
	App\Modules\Admin\Components\TopMenu,
	App\Modules\Admin\Components\LeftMenu,
	App\Modules\Admin\Components\Breadcrumbs
		;

/**
 * Description of BaseAdminPresenter
 *
 * @author KuBik
 */
abstract class BaseAdminPresenter extends SecurePresenter{
	protected function createComponentTopMenu() {
		$menu = new TopMenu();
		return $menu;
	}
	protected function createComponentLeftMenu() {
		$menu = new LeftMenu();
		return $menu;
	}
	protected function createComponentBreacrumbs() {
		$menu = new Breadcrumbs();
		return $menu;
	}
	
	protected function beforeRender() {
		parent::beforeRender();
		
		$this->template->setTranslator(\App\Model\Translator::get());
	}
}
