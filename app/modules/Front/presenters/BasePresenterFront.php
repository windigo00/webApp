<?php

namespace App\Modules\Front\Presenters;

use Nette\Environment,
	Nette\Database\Context,
	App\Modules\Front\Components\MenuComponent,
	App\Modules\Front\Components\Breadcrumbs,
	App\Model\Presenters\BasePresenter

;

/**
 * Description of BasePresenterFrontFront
 *
 * @author KuBik
 */
abstract class BasePresenterFront extends BasePresenter {

	public function createComponentNavigation() {
		$ctrl = new MenuComponent();
		return $ctrl;
	}

	public function createComponentBreadcrumbs() {
		$ctrl = new Breadcrumbs();
		return $ctrl;
	}


}
