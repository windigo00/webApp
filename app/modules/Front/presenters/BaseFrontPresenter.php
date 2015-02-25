<?php

namespace App\Modules\Front\Presenters;

use App\Modules\Front\Components\MenuComponent,
	App\Modules\Front\Components\Breadcrumbs,
	App\Model\Presenters\BasePresenter
;

/**
 * Description of BasePresenterFrontFront
 *
 * @author KuBik
 */
abstract class BaseFrontPresenter extends BasePresenter {

	public function createComponentNavigation() {
		$ctrl = new MenuComponent();
		return $ctrl;
	}

	public function createComponentBreadcrumbs() {
		$ctrl = new Breadcrumbs();
		return $ctrl;
	}


}
