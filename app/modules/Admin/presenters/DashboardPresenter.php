<?php

namespace App\Modules\Admin\Presenters;

use Nette,
    App\Model
        ;


/**
 * Dashboard presenter.
 */
class DashboardPresenter extends BasePresenterAdmin
{

	public function renderDefault()
	{
		$tmp = Model\Document\Document::getById(1);
		$this->template->anyVariable = $tmp;
	}

}
