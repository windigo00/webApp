<?php

namespace App\Modules\Shop\Presenters;

use App\Modules\Shop\Components\MenuComponent,
	App\Modules\Shop\Components\Breadcrumbs,
	App\Model\Presenters\BasePresenter

	;

/**
 * Description of BasePresenterFrontFront
 *
 * @author KuBik
 */
abstract class BaseShopPresenter extends BasePresenter {

	public function createComponentNavigation() {
		$ctrl = new MenuComponent();
		return $ctrl;
	}

	public function createComponentBreadcrumbs() {
		$ctrl = new Breadcrumbs();
		return $ctrl;
	}

}
