<?php

namespace App\Modules\Shop\Presenters;

use App\Modules\Shop\Components\MenuComponent,
	App\Modules\Shop\Components\Breadcrumbs,
	App\Presenters\SecurePresenter

	;

/**
 * Description of BasePresenterFrontFront
 *
 * @author KuBik
 */
abstract class SecureShopPresenter extends SecurePresenter{

	protected function startup() {
		dump($this->user->loggedIn);
		parent::startup();
	}
	
	public function createComponentNavigation() {
		$ctrl = new MenuComponent();
		return $ctrl;
	}

	public function createComponentBreadcrumbs() {
		$ctrl = new Breadcrumbs();
		return $ctrl;
	}

}
