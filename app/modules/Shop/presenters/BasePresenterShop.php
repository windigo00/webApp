<?php

namespace App\Modules\Shop\Presenters;

use Nette\Environment,
	Nette\Database\Context,
	App\Modules\Shop\Components\MenuComponent,
	App\Modules\Shop\Components\Breadcrumbs,
	App\Model\Presenters\SecurePresenter

;

/**
 * Description of BasePresenterFrontFront
 *
 * @author KuBik
 */
abstract class BasePresenterShop extends SecurePresenter {

	public function createComponentNavigation() {
		$ctrl = new MenuComponent();
		return $ctrl;
	}

	public function createComponentBreadcrumbs() {
		$ctrl = new Breadcrumbs();
		return $ctrl;
	}

}
