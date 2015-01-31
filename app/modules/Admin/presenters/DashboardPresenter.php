<?php

namespace App\Modules\Admin\Presenters;

use Nette,
    App\Model,
	Model\Document\Document,
	App\Admin\Model\Language
		;


/**
 * Dashboard presenter.
 */
class DashboardPresenter extends BaseAdminPresenter
{
	public function renderDefault()
	{
		$tmp = Language::getAll();
		$this->template->anyVariable = $tmp;
	}

}
